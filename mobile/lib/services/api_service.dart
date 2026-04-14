import 'dart:convert';
import 'dart:io';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';

class ApiService {
  static const String baseUrl = 'http://10.15.16.203:8000/api';
  static const String loginUrl = '$baseUrl/login';
  static const String registerUrl = '$baseUrl/register';
  static const String logoutUrl = '$baseUrl/logout';
  static const String userUrl = '$baseUrl/user';

  // Singleton pattern
  static final ApiService _instance = ApiService._internal();
  factory ApiService() => _instance;
  ApiService._internal();

  // Get stored token
  Future<String?> getToken() async {
    final prefs = await SharedPreferences.getInstance();
    return prefs.getString('auth_token');
  }

  // Save token
  Future<void> saveToken(String token) async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.setString('auth_token', token);
  }

  // Remove token (logout)
  Future<void> removeToken() async {
    final prefs = await SharedPreferences.getInstance();
    await prefs.remove('auth_token');
    await prefs.remove('user_data');
  }

  // Get auth headers
  Future<Map<String, String>> getHeaders() async {
    final token = await getToken();
    return {
      'Content-Type': 'application/json',
      'Accept': 'application/json',
      if (token != null) 'Authorization': 'Bearer $token',
    };
  }

  // LOGIN with phone
  Future<Map<String, dynamic>> login({
    String? phone,
    String? email,
    required String password,
  }) async {
    try {
      final body = phone != null && phone.isNotEmpty
          ? {'phone': phone, 'password': password}
          : {'email': email, 'password': password};

      final response = await http.post(
        Uri.parse(loginUrl),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: jsonEncode(body),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 || response.statusCode == 201) {
        // Save token if provided
        if (data['token'] != null) {
          await saveToken(data['token']);
        }
        // Save user data
        if (data['user'] != null) {
          final prefs = await SharedPreferences.getInstance();
          await prefs.setString('user_data', jsonEncode(data['user']));
        }
        return {
          'success': true,
          'data': data,
          'message': data['message'] ?? 'Login successful',
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Login failed',
          'errors': data['errors'],
        };
      }
    } on SocketException {
      return {
        'success': false,
        'message': 'No internet connection. Please check your network.',
      };
    } on FormatException {
      return {
        'success': false,
        'message': 'Invalid response from server.',
      };
    } catch (e) {
      return {
        'success': false,
        'message': 'An error occurred: $e',
      };
    }
  }

  // REGISTER with phone
  Future<Map<String, dynamic>> register({
    required String name,
    required String phone,
    String? email,
    required String password,
    required String passwordConfirmation,
  }) async {
    try {
      final response = await http.post(
        Uri.parse(registerUrl),
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
        body: jsonEncode({
          'name': name,
          'phone': phone,
          'email': email,
          'password': password,
          'password_confirmation': passwordConfirmation,
        }),
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200 || response.statusCode == 201) {
        if (data['token'] != null) {
          await saveToken(data['token']);
        }
        return {
          'success': true,
          'data': data,
          'message': data['message'] ?? 'Registration successful',
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Registration failed',
          'errors': data['errors'],
        };
      }
    } on SocketException {
      return {
        'success': false,
        'message': 'No internet connection. Please check your network.',
      };
    } catch (e) {
      return {
        'success': false,
        'message': 'An error occurred: $e',
      };
    }
  }

  // LOGOUT
  Future<Map<String, dynamic>> logout() async {
    try {
      final headers = await getHeaders();
      final response = await http.post(
        Uri.parse(logoutUrl),
        headers: headers,
      );

      await removeToken();

      if (response.statusCode == 200 || response.statusCode == 204) {
        return {
          'success': true,
          'message': 'Logged out successfully',
        };
      } else {
        return {
          'success': false,
          'message': 'Logout failed',
        };
      }
    } catch (e) {
      await removeToken();
      return {
        'success': true,
        'message': 'Logged out locally',
      };
    }
  }

  // GET USER
  Future<Map<String, dynamic>> getUser() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse(userUrl),
        headers: headers,
      );

      final data = jsonDecode(response.body);

      if (response.statusCode == 200) {
        return {
          'success': true,
          'data': data,
        };
      } else {
        return {
          'success': false,
          'message': data['message'] ?? 'Failed to get user',
        };
      }
    } catch (e) {
      return {
        'success': false,
        'message': 'An error occurred: $e',
      };
    }
  }

  // DASHBOARD ENDPOINTS
  Future<Map<String, dynamic>> getDashboard() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get dashboard: $e',
      };
    }
  }

  Future<Map<String, dynamic>> getDashboardStats() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard/stats'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get stats: $e',
      };
    }
  }

  Future<Map<String, dynamic>> getRecentActivity() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard/recent-activity'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get activity: $e',
      };
    }
  }

  // Get sales chart data
  Future<Map<String, dynamic>> getSalesChart(String period) async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard/chart?sales&period=$period'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get chart: $e',
      };
    }
  }

  // Get visitor stats
  Future<Map<String, dynamic>> getVisitorStats() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard/visitors'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get visitors: $e',
      };
    }
  }

  // Get store link
  Future<Map<String, dynamic>> getStoreLink() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/store/link'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get store link: $e',
      };
    }
  }

  // Get all stats
  Future<Map<String, dynamic>> getAllStats() async {
    try {
      final headers = await getHeaders();
      final response = await http.get(
        Uri.parse('$baseUrl/dashboard/all-stats'),
        headers: headers,
      );

      final data = jsonDecode(response.body);
      return data;
    } catch (e) {
      return {
        'success': false,
        'message': 'Failed to get stats: $e',
      };
    }
  }

  // Check if user is logged in
  Future<bool> isLoggedIn() async {
    final token = await getToken();
    return token != null;
  }
}
