import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../theme/app_theme.dart';
import '../services/api_service.dart';

class NotificationsScreen extends StatefulWidget {
  const NotificationsScreen({super.key});

  @override
  State<NotificationsScreen> createState() => _NotificationsScreenState();
}

class _NotificationsScreenState extends State<NotificationsScreen> {
  final _apiService = ApiService();
  bool _orderNotifications = true;
  bool _paymentNotifications = true;
  bool _promoNotifications = false;
  bool _stockNotifications = true;
  bool _emailNotifications = true;
  bool _smsNotifications = false;

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: Container(
        decoration: const BoxDecoration(
          gradient: LinearGradient(
            begin: Alignment.topLeft,
            end: Alignment.bottomRight,
            colors: [
              Color(0xFF15803d),
              Color(0xFF166534),
              Color(0xFF14532d),
            ],
          ),
        ),
        child: SafeArea(
          child: Column(
            children: [
              // Header
              Padding(
                padding: const EdgeInsets.all(20),
                child: Row(
                  children: [
                    GestureDetector(
                      onTap: () => Navigator.pop(context),
                      child: Container(
                        width: 44,
                        height: 44,
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.2),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: const Icon(Icons.arrow_back, color: Colors.white),
                      ),
                    ),
                    const SizedBox(width: 16),
                    Text(
                      'Notifications',
                      style: GoogleFonts.nunito(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                  ],
                ),
              ),

              // Settings
              Expanded(
                child: Container(
                  margin: const EdgeInsets.symmetric(horizontal: 20),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(24),
                  ),
                  child: SingleChildScrollView(
                    padding: const EdgeInsets.all(24),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          'Push Notifications',
                          style: GoogleFonts.nunito(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 16),
                        _buildToggleTile(
                          title: 'New Orders',
                          subtitle: 'Get notified when you receive an order',
                          icon: Icons.shopping_bag_outlined,
                          value: _orderNotifications,
                          onChanged: (v) => setState(() => _orderNotifications = v),
                        ),
                        _buildToggleTile(
                          title: 'Payments',
                          subtitle: 'Payment confirmations and updates',
                          icon: Icons.payments_outlined,
                          value: _paymentNotifications,
                          onChanged: (v) => setState(() => _paymentNotifications = v),
                        ),
                        _buildToggleTile(
                          title: 'Low Stock Alerts',
                          subtitle: 'When product stock is running low',
                          icon: Icons.inventory_2_outlined,
                          value: _stockNotifications,
                          onChanged: (v) => setState(() => _stockNotifications = v),
                        ),
                        _buildToggleTile(
                          title: 'Promotions',
                          subtitle: 'Tips and promotional content',
                          icon: Icons.local_offer_outlined,
                          value: _promoNotifications,
                          onChanged: (v) => setState(() => _promoNotifications = v),
                        ),

                        const SizedBox(height: 24),
                        const Divider(),
                        const SizedBox(height: 24),

                        Text(
                          'Notification Channels',
                          style: GoogleFonts.nunito(
                            fontSize: 18,
                            fontWeight: FontWeight.bold,
                          ),
                        ),
                        const SizedBox(height: 16),
                        _buildToggleTile(
                          title: 'Email Notifications',
                          subtitle: 'Send notifications to your email',
                          icon: Icons.email_outlined,
                          value: _emailNotifications,
                          onChanged: (v) => setState(() => _emailNotifications = v),
                        ),
                        _buildToggleTile(
                          title: 'SMS Notifications',
                          subtitle: 'Send notifications via SMS',
                          icon: Icons.sms_outlined,
                          value: _smsNotifications,
                          onChanged: (v) => setState(() => _smsNotifications = v),
                        ),

                        const SizedBox(height: 32),
                        SizedBox(
                          width: double.infinity,
                          height: 56,
                          child: ElevatedButton(
                            onPressed: () {
                              ScaffoldMessenger.of(context).showSnackBar(
                                SnackBar(
                                  content: Text(
                                    'Settings saved!',
                                    style: GoogleFonts.nunito(),
                                  ),
                                  backgroundColor: Colors.green,
                                ),
                              );
                            },
                            style: ElevatedButton.styleFrom(
                              backgroundColor: AppTheme.primaryGreen,
                              foregroundColor: Colors.white,
                              shape: RoundedRectangleBorder(
                                borderRadius: BorderRadius.circular(16),
                              ),
                            ),
                            child: Text(
                              'Save Settings',
                              style: GoogleFonts.nunito(
                                fontSize: 18,
                                fontWeight: FontWeight.bold,
                              ),
                            ),
                          ),
                        ),
                      ],
                    ),
                  ),
                ),
              ),

              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildToggleTile({
    required String title,
    required String subtitle,
    required IconData icon,
    required bool value,
    required ValueChanged<bool> onChanged,
  }) {
    return Padding(
      padding: const EdgeInsets.only(bottom: 16),
      child: Row(
        children: [
          Container(
            width: 48,
            height: 48,
            decoration: BoxDecoration(
              color: AppTheme.primaryGreen.withOpacity(0.1),
              borderRadius: BorderRadius.circular(12),
            ),
            child: Icon(icon, color: AppTheme.primaryGreen),
          ),
          const SizedBox(width: 16),
          Expanded(
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.start,
              children: [
                Text(
                  title,
                  style: GoogleFonts.nunito(
                    fontWeight: FontWeight.w600,
                    fontSize: 16,
                  ),
                ),
                Text(
                  subtitle,
                  style: GoogleFonts.nunito(
                    fontSize: 13,
                    color: AppTheme.textGray,
                  ),
                ),
              ],
            ),
          ),
          Switch(
            value: value,
            onChanged: onChanged,
            activeColor: AppTheme.primaryGreen,
          ),
        ],
      ),
    );
  }
}
