import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../theme/app_theme.dart';
import '../services/api_service.dart';
import 'auth_screen.dart';

class ProfileScreen extends StatefulWidget {
  final String userName;
  final String? userEmail;
  final String? userPhone;
  final String? avatarUrl;

  const ProfileScreen({
    super.key,
    required this.userName,
    this.userEmail,
    this.userPhone,
    this.avatarUrl,
  });

  @override
  State<ProfileScreen> createState() => _ProfileScreenState();
}

class _ProfileScreenState extends State<ProfileScreen> {
  final _apiService = ApiService();
  final _nameController = TextEditingController();
  final _emailController = TextEditingController();
  final _phoneController = TextEditingController();
  final _businessNameController = TextEditingController();
  final _locationController = TextEditingController();

  bool _isLoading = false;
  bool _isEditing = false;
  String? _errorMessage;

  @override
  void initState() {
    super.initState();
    _nameController.text = widget.userName;
    _emailController.text = widget.userEmail ?? '';
    _phoneController.text = widget.userPhone ?? '';
  }

  @override
  void dispose() {
    _nameController.dispose();
    _emailController.dispose();
    _phoneController.dispose();
    _businessNameController.dispose();
    _locationController.dispose();
    super.dispose();
  }

  Future<void> _updateProfile() async {
    if (!_isEditing) {
      setState(() => _isEditing = true);
      return;
    }

    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    // Simulate API call
    await Future.delayed(const Duration(seconds: 1));

    setState(() {
      _isLoading = false;
      _isEditing = false;
    });

    if (mounted) {
      ScaffoldMessenger.of(context).showSnackBar(
        SnackBar(
          content: Text(
            'Profile updated successfully!',
            style: GoogleFonts.nunito(),
          ),
          backgroundColor: Colors.green,
          behavior: SnackBarBehavior.floating,
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(10),
          ),
        ),
      );
    }
  }

  Future<void> _logout() async {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(16),
        ),
        title: Text(
          'Logout',
          style: GoogleFonts.nunito(
            fontWeight: FontWeight.bold,
          ),
        ),
        content: Text(
          'Are you sure you want to logout?',
          style: GoogleFonts.nunito(),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: Text(
              'Cancel',
              style: GoogleFonts.nunito(color: Colors.grey),
            ),
          ),
          TextButton(
            onPressed: () async {
              Navigator.pop(context);
              await _apiService.logout();
              if (mounted) {
                Navigator.of(context).pushAndRemoveUntil(
                  MaterialPageRoute(builder: (_) => const AuthScreen()),
                  (route) => false,
                );
              }
            },
            child: Text(
              'Logout',
              style: GoogleFonts.nunito(
                color: AppTheme.errorColor,
                fontWeight: FontWeight.bold,
              ),
            ),
          ),
        ],
      ),
    );
  }

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
          child: SingleChildScrollView(
            physics: const BouncingScrollPhysics(),
            child: Column(
              children: [
                _buildHeader(),
                const SizedBox(height: 20),
                _buildProfileCard(),
                const SizedBox(height: 20),
                _buildLogoutButton(),
                const SizedBox(height: 30),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildHeader() {
    return Padding(
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
              child: const Icon(
                Icons.arrow_back,
                color: Colors.white,
                size: 24,
              ),
            ),
          ),
          const SizedBox(width: 16),
          Text(
            'My Profile',
            style: GoogleFonts.nunito(
              fontSize: 24,
              fontWeight: FontWeight.bold,
              color: Colors.white,
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildProfileCard() {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20),
      padding: const EdgeInsets.all(24),
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(24),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.2),
            blurRadius: 30,
            spreadRadius: 8,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: Column(
        children: [
          // Avatar
          _buildAvatarSection(),
          const SizedBox(height: 24),
          // Form fields
          if (_errorMessage != null) ...[
            _buildErrorBanner(),
            const SizedBox(height: 16),
          ],
          _buildFormField(
            label: 'Full Name',
            controller: _nameController,
            icon: Icons.person_outline,
            enabled: _isEditing,
          ),
          const SizedBox(height: 16),
          _buildFormField(
            label: 'Email Address',
            controller: _emailController,
            icon: Icons.email_outlined,
            keyboardType: TextInputType.emailAddress,
            enabled: _isEditing,
            hintText: widget.userEmail == null || widget.userEmail!.contains('@placeholder.com')
                ? 'Add your email address'
                : null,
          ),
          const SizedBox(height: 16),
          _buildFormField(
            label: 'Phone Number',
            controller: _phoneController,
            icon: Icons.phone_outlined,
            keyboardType: TextInputType.phone,
            enabled: false, // Phone cannot be changed
          ),
          const SizedBox(height: 16),
          _buildFormField(
            label: 'Business Name',
            controller: _businessNameController,
            icon: Icons.store_outlined,
            enabled: _isEditing,
            hintText: 'Add your business name',
          ),
          const SizedBox(height: 16),
          _buildFormField(
            label: 'Location',
            controller: _locationController,
            icon: Icons.location_on_outlined,
            enabled: _isEditing,
            hintText: 'Add your business location',
          ),
          const SizedBox(height: 24),
          // Save/Edit button
          _buildActionButton(),
        ],
      ),
    );
  }

  Widget _buildAvatarSection() {
    return Column(
      children: [
        Container(
          width: 100,
          height: 100,
          decoration: BoxDecoration(
            color: Colors.white,
            borderRadius: BorderRadius.circular(24),
            border: Border.all(
              color: AppTheme.primaryGreen.withOpacity(0.3),
              width: 3,
            ),
            boxShadow: [
              BoxShadow(
                color: AppTheme.primaryGreen.withOpacity(0.2),
                blurRadius: 20,
                spreadRadius: 5,
              ),
            ],
          ),
          child: ClipRRect(
            borderRadius: BorderRadius.circular(21),
            child: widget.avatarUrl != null
                ? Image.network(
                    widget.avatarUrl!,
                    fit: BoxFit.cover,
                    errorBuilder: (context, error, stackTrace) =>
                        _buildDefaultAvatar(),
                  )
                : _buildDefaultAvatar(),
          ),
        ),
        const SizedBox(height: 12),
        Text(
          widget.userName,
          style: GoogleFonts.nunito(
            fontSize: 20,
            fontWeight: FontWeight.bold,
            color: AppTheme.textDark,
          ),
        ),
        Text(
          'Member since ${DateTime.now().year}',
          style: GoogleFonts.nunito(
            fontSize: 13,
            color: AppTheme.textGray,
          ),
        ),
      ],
    );
  }

  Widget _buildDefaultAvatar() {
    final initials = _getInitials(widget.userName);
    return Container(
      color: AppTheme.primaryGreen.withOpacity(0.1),
      child: Center(
        child: Text(
          initials,
          style: GoogleFonts.nunito(
            fontSize: 36,
            fontWeight: FontWeight.bold,
            color: AppTheme.primaryGreen,
          ),
        ),
      ),
    );
  }

  String _getInitials(String name) {
    final parts = name.split(' ');
    if (parts.length >= 2) {
      return '${parts[0][0]}${parts[1][0]}'.toUpperCase();
    }
    return name.substring(0, min(2, name.length)).toUpperCase();
  }

  int min(int a, int b) => a < b ? a : b;

  Widget _buildFormField({
    required String label,
    required TextEditingController controller,
    required IconData icon,
    TextInputType? keyboardType,
    bool enabled = true,
    String? hintText,
  }) {
    final isEmpty = controller.text.isEmpty;
    final showHint = hintText != null && isEmpty;

    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          label,
          style: GoogleFonts.nunito(
            fontSize: 13,
            fontWeight: FontWeight.w600,
            color: enabled ? AppTheme.textDark : AppTheme.textGray,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: controller,
          keyboardType: keyboardType,
          enabled: enabled,
          style: GoogleFonts.nunito(
            fontSize: 15,
            color: AppTheme.textDark,
          ),
          decoration: InputDecoration(
            hintText: showHint ? hintText : null,
            hintStyle: GoogleFonts.nunito(
              fontSize: 14,
              color: AppTheme.errorColor.withOpacity(0.6),
            ),
            prefixIcon: Container(
              margin: const EdgeInsets.all(12),
              child: Icon(
                icon,
                color: enabled ? AppTheme.primaryGreen : AppTheme.textGray,
                size: 20,
              ),
            ),
            filled: true,
            fillColor: enabled ? const Color(0xFFf1f5f9) : const Color(0xFFe2e8f0),
            border: OutlineInputBorder(
              borderRadius: BorderRadius.circular(14),
              borderSide: BorderSide.none,
            ),
            enabledBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(14),
              borderSide: BorderSide.none,
            ),
            focusedBorder: OutlineInputBorder(
              borderRadius: BorderRadius.circular(14),
              borderSide: const BorderSide(
                color: AppTheme.primaryGreen,
                width: 2,
              ),
            ),
            contentPadding: const EdgeInsets.symmetric(
              horizontal: 16,
              vertical: 16,
            ),
            suffixIcon: showHint
                ? Container(
                    margin: const EdgeInsets.all(12),
                    child: Icon(
                      Icons.warning_amber_rounded,
                      color: AppTheme.errorColor.withOpacity(0.5),
                      size: 18,
                    ),
                  )
                : null,
          ),
        ),
      ],
    );
  }

  Widget _buildErrorBanner() {
    return Container(
      padding: const EdgeInsets.all(12),
      decoration: BoxDecoration(
        color: AppTheme.errorColor.withOpacity(0.1),
        borderRadius: BorderRadius.circular(12),
        border: Border.all(
          color: AppTheme.errorColor.withOpacity(0.3),
        ),
      ),
      child: Row(
        children: [
          const Icon(
            Icons.error_outline,
            color: AppTheme.errorColor,
            size: 20,
          ),
          const SizedBox(width: 10),
          Expanded(
            child: Text(
              _errorMessage!,
              style: GoogleFonts.nunito(
                fontSize: 13,
                color: AppTheme.errorColor,
                fontWeight: FontWeight.w500,
              ),
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildActionButton() {
    return Container(
      height: 56,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(14),
        gradient: const LinearGradient(
          begin: Alignment.topLeft,
          end: Alignment.bottomRight,
          colors: [
            AppTheme.primaryGreen,
            AppTheme.primaryGreenDark,
          ],
        ),
        boxShadow: [
          BoxShadow(
            color: AppTheme.primaryGreen.withOpacity(0.4),
            blurRadius: 20,
            spreadRadius: 4,
            offset: const Offset(0, 8),
          ),
        ],
      ),
      child: Material(
        color: Colors.transparent,
        borderRadius: BorderRadius.circular(14),
        child: InkWell(
          onTap: _isLoading ? null : _updateProfile,
          borderRadius: BorderRadius.circular(14),
          child: Center(
            child: _isLoading
                ? const Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      SizedBox(
                        width: 22,
                        height: 22,
                        child: CircularProgressIndicator(
                          strokeWidth: 2.5,
                          valueColor: AlwaysStoppedAnimation<Color>(
                            Colors.white,
                          ),
                        ),
                      ),
                      SizedBox(width: 12),
                      Text(
                        'Saving...',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  )
                : Row(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: [
                      Icon(
                        _isEditing ? Icons.save_outlined : Icons.edit_outlined,
                        color: Colors.white,
                        size: 22,
                      ),
                      const SizedBox(width: 8),
                      Text(
                        _isEditing ? 'Save Changes' : 'Edit Profile',
                        style: const TextStyle(
                          color: Colors.white,
                          fontSize: 17,
                          fontWeight: FontWeight.w700,
                        ),
                      ),
                    ],
                  ),
          ),
        ),
      ),
    );
  }

  Widget _buildLogoutButton() {
    return Container(
      margin: const EdgeInsets.symmetric(horizontal: 20),
      height: 56,
      decoration: BoxDecoration(
        borderRadius: BorderRadius.circular(14),
        color: Colors.white.withOpacity(0.15),
        border: Border.all(
          color: Colors.white.withOpacity(0.3),
          width: 1,
        ),
      ),
      child: Material(
        color: Colors.transparent,
        borderRadius: BorderRadius.circular(14),
        child: InkWell(
          onTap: _logout,
          borderRadius: BorderRadius.circular(14),
          child: Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              const Icon(
                Icons.logout,
                color: Colors.white,
                size: 22,
              ),
              const SizedBox(width: 12),
              Text(
                'Logout',
                style: GoogleFonts.nunito(
                  fontSize: 17,
                  fontWeight: FontWeight.w700,
                  color: Colors.white,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
