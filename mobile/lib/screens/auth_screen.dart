import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../theme/app_theme.dart';
import '../services/api_service.dart';
import 'home_screen.dart';
import 'forgot_password_screen.dart';
import 'register_screen.dart';

class AuthScreen extends StatefulWidget {
  const AuthScreen({super.key});

  @override
  State<AuthScreen> createState() => _AuthScreenState();
}

class _AuthScreenState extends State<AuthScreen>
    with TickerProviderStateMixin {
  final _formKey = GlobalKey<FormState>();
  final _phoneController = TextEditingController();
  final _passwordController = TextEditingController();
  final _apiService = ApiService();

  bool _isPasswordVisible = false;
  bool _isLoading = false;
  String? _errorMessage;

  late AnimationController _controller;
  late Animation<double> _fadeAnimation;
  late Animation<Offset> _slideAnimation;
  late Animation<double> _scaleAnimation;

  @override
  void initState() {
    super.initState();
    _controller = AnimationController(
      duration: const Duration(milliseconds: 1200),
      vsync: this,
    );

    _fadeAnimation = Tween<double>(begin: 0.0, end: 1.0).animate(
      CurvedAnimation(
        parent: _controller,
        curve: const Interval(0.0, 0.6, curve: Curves.easeOut),
      ),
    );

    _slideAnimation = Tween<Offset>(
      begin: const Offset(0, 0.5),
      end: Offset.zero,
    ).animate(
      CurvedAnimation(
        parent: _controller,
        curve: const Interval(0.2, 0.8, curve: Curves.easeOutCubic),
      ),
    );

    _scaleAnimation = Tween<double>(begin: 0.8, end: 1.0).animate(
      CurvedAnimation(
        parent: _controller,
        curve: const Interval(0.0, 0.6, curve: Curves.easeOutBack),
      ),
    );

    _controller.forward();
  }

  @override
  void dispose() {
    _controller.dispose();
    _phoneController.dispose();
    _passwordController.dispose();
    super.dispose();
  }

  void _togglePasswordVisibility() {
    setState(() {
      _isPasswordVisible = !_isPasswordVisible;
    });
  }

  Future<void> _signIn() async {
    if (!_formKey.currentState!.validate()) return;

    setState(() {
      _isLoading = true;
      _errorMessage = null;
    });

    final result = await _apiService.login(
      phone: _phoneController.text.trim(),
      password: _passwordController.text,
    );

    setState(() {
      _isLoading = false;
    });

    if (result['success']) {
      if (mounted) {
        // Show success message
        ScaffoldMessenger.of(context).showSnackBar(
          SnackBar(
            content: Text(
              result['message'] ?? 'Login successful!',
              style: GoogleFonts.nunito(),
            ),
            backgroundColor: Colors.green,
            behavior: SnackBarBehavior.floating,
            shape: RoundedRectangleBorder(
              borderRadius: BorderRadius.circular(10),
            ),
          ),
        );

        // Navigate to dashboard after short delay
        await Future.delayed(const Duration(milliseconds: 800));

        if (mounted) {
          Navigator.of(context).pushAndRemoveUntil(
            MaterialPageRoute(builder: (_) => const HomeScreen()),
            (route) => false,
          );
        }
      }
    } else {
      setState(() {
        _errorMessage = result['message'] ?? 'Login failed';
      });
    }
  }

  void _navigateToForgotPassword() {
    Navigator.of(context).push(
      MaterialPageRoute(builder: (_) => const ForgotPasswordScreen()),
    );
  }

  void _navigateToRegister() {
    Navigator.of(context).push(
      MaterialPageRoute(builder: (_) => const RegisterScreen()),
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
            stops: [0.0, 0.5, 1.0],
          ),
        ),
        child: SafeArea(
          child: FadeTransition(
            opacity: _fadeAnimation,
            child: SlideTransition(
              position: _slideAnimation,
              child: SingleChildScrollView(
                physics: const BouncingScrollPhysics(),
                child: Padding(
                  padding: const EdgeInsets.symmetric(
                    horizontal: 20,
                    vertical: 24,
                  ),
                  child: Column(
                    children: [
                      const SizedBox(height: 20),
                      _buildBrandingSection(),
                      const SizedBox(height: 30),
                      _buildPowerfulCard(),
                      const SizedBox(height: 24),
                      _buildFooter(),
                    ],
                  ),
                ),
              ),
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildBrandingSection() {
    return ScaleTransition(
      scale: _scaleAnimation,
      child: Column(
        children: [
          // Logo with glow effect
          Container(
            width: 110,
            height: 110,
            decoration: BoxDecoration(
              shape: BoxShape.circle,
              color: Colors.white,
              boxShadow: [
                BoxShadow(
                  color: Colors.white.withOpacity(0.4),
                  blurRadius: 30,
                  spreadRadius: 10,
                ),
                BoxShadow(
                  color: AppTheme.primaryGreenLight.withOpacity(0.3),
                  blurRadius: 20,
                  spreadRadius: 5,
                ),
              ],
            ),
            child: ClipOval(
              child: Image.asset(
                'assets/images/logo.png',
                fit: BoxFit.cover,
                errorBuilder: (context, error, stackTrace) => const Icon(
                  Icons.shield_outlined,
                  size: 60,
                  color: AppTheme.primaryGreen,
                ),
              ),
            ),
          ),
          const SizedBox(height: 24),
          // Title
          Text(
            'SalamaPay',
            style: GoogleFonts.nunito(
              fontSize: 32,
              fontWeight: FontWeight.bold,
              color: Colors.white,
              shadows: [
                Shadow(
                  color: Colors.black.withOpacity(0.3),
                  blurRadius: 15,
                  offset: const Offset(0, 5),
                ),
              ],
            ),
          ),
          const SizedBox(height: 10),
          // Subtitle
          Container(
            padding: const EdgeInsets.symmetric(horizontal: 20),
            child: Text(
              'CREATE YOUR ONLINE STORE & SELL ANYWHERE',
              textAlign: TextAlign.center,
              style: GoogleFonts.nunito(
                fontSize: 11,
                fontWeight: FontWeight.w700,
                color: Colors.white.withOpacity(0.95),
                letterSpacing: 1.2,
              ),
            ),
          ),
          const SizedBox(height: 16),
          // Animated divider
          Container(
            width: 60,
            height: 4,
            decoration: BoxDecoration(
              gradient: const LinearGradient(
                colors: [
                  AppTheme.primaryGreenLight,
                  Colors.white,
                  AppTheme.primaryGreenLight,
                ],
              ),
              borderRadius: BorderRadius.circular(2),
              boxShadow: [
                BoxShadow(
                  color: Colors.white.withOpacity(0.5),
                  blurRadius: 10,
                  spreadRadius: 2,
                ),
              ],
            ),
          ),
        ],
      ),
    );
  }

  Widget _buildPowerfulCard() {
    return Container(
      decoration: BoxDecoration(
        color: Colors.white,
        borderRadius: BorderRadius.circular(28),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.2),
            blurRadius: 40,
            spreadRadius: 8,
            offset: const Offset(0, 15),
          ),
          BoxShadow(
            color: AppTheme.primaryGreen.withOpacity(0.1),
            blurRadius: 30,
            spreadRadius: 5,
            offset: const Offset(0, 10),
          ),
        ],
      ),
      child: ClipRRect(
        borderRadius: BorderRadius.circular(28),
        child: Container(
          padding: const EdgeInsets.all(28),
          decoration: BoxDecoration(
            gradient: LinearGradient(
              begin: Alignment.topLeft,
              end: Alignment.bottomRight,
              colors: [
                Colors.white,
                const Color(0xFFf8fafc),
              ],
            ),
          ),
          child: Form(
            key: _formKey,
            child: Column(
              crossAxisAlignment: CrossAxisAlignment.stretch,
              children: [
                // Header
                _buildCardHeader(),
                const SizedBox(height: 20),
                // Social Login Icons (Row)
                _buildSocialIconsRow(),
                const SizedBox(height: 20),
                // Divider
                _buildOrDivider(),
                const SizedBox(height: 20),
                // Error message
                if (_errorMessage != null) _buildErrorBanner(),
                if (_errorMessage != null) const SizedBox(height: 16),
                // Phone field
                _buildPhoneField(),
                const SizedBox(height: 20),
                // Password field
                _buildPasswordField(),
                const SizedBox(height: 12),
                // Forgot password
                _buildForgotPassword(),
                const SizedBox(height: 24),
                // Sign in button
                _buildPowerfulSignInButton(),
                const SizedBox(height: 24),
                // Create account
                _buildCreateAccount(),
              ],
            ),
          ),
        ),
      ),
    );
  }

  Widget _buildCardHeader() {
    return Column(
      children: [
        Text(
          'Welcome back',
          style: GoogleFonts.nunito(
            fontSize: 26,
            fontWeight: FontWeight.bold,
            color: AppTheme.textDark,
          ),
        ),
        const SizedBox(height: 6),
        Text(
          'Sign in to your account',
          textAlign: TextAlign.center,
          style: GoogleFonts.nunito(
            fontSize: 14,
            color: AppTheme.textGray,
            height: 1.4,
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

  Widget _buildPhoneField() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          'Phone Number *',
          style: GoogleFonts.nunito(
            fontSize: 13,
            fontWeight: FontWeight.w600,
            color: AppTheme.textDark,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: _phoneController,
          keyboardType: TextInputType.phone,
          textInputAction: TextInputAction.next,
          style: GoogleFonts.nunito(
            fontSize: 15,
            color: AppTheme.textDark,
          ),
          decoration: InputDecoration(
            hintText: '712345678',
            hintStyle: GoogleFonts.nunito(
              fontSize: 14,
              color: AppTheme.textLight,
            ),
            prefixIcon: Container(
              margin: const EdgeInsets.all(12),
              child: const Row(
                mainAxisSize: MainAxisSize.min,
                children: [
                  Text(
                    '🇹🇿 +255',
                    style: TextStyle(fontSize: 14),
                  ),
                  SizedBox(width: 8),
                  Icon(
                    Icons.phone_outlined,
                    color: AppTheme.primaryGreen,
                    size: 20,
                  ),
                ],
              ),
            ),
            filled: true,
            fillColor: const Color(0xFFf1f5f9),
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
          ),
          validator: (value) {
            if (value == null || value.isEmpty) {
              return 'Please enter your phone number';
            }
            if (value.length < 9) {
              return 'Phone number must be at least 9 digits';
            }
            return null;
          },
        ),
      ],
    );
  }

  Widget _buildPasswordField() {
    return Column(
      crossAxisAlignment: CrossAxisAlignment.start,
      children: [
        Text(
          'Password',
          style: GoogleFonts.nunito(
            fontSize: 13,
            fontWeight: FontWeight.w600,
            color: AppTheme.textDark,
          ),
        ),
        const SizedBox(height: 8),
        TextFormField(
          controller: _passwordController,
          obscureText: !_isPasswordVisible,
          textInputAction: TextInputAction.done,
          style: GoogleFonts.nunito(
            fontSize: 15,
            color: AppTheme.textDark,
          ),
          decoration: InputDecoration(
            hintText: 'Enter your password',
            hintStyle: GoogleFonts.nunito(
              fontSize: 14,
              color: AppTheme.textLight,
            ),
            prefixIcon: Container(
              margin: const EdgeInsets.all(12),
              child: const Icon(
                Icons.lock_outline,
                color: AppTheme.primaryGreen,
                size: 20,
              ),
            ),
            suffixIcon: IconButton(
              onPressed: _togglePasswordVisibility,
              icon: Icon(
                _isPasswordVisible
                    ? Icons.visibility_off_outlined
                    : Icons.visibility_outlined,
                color: AppTheme.textGray,
                size: 20,
              ),
            ),
            filled: true,
            fillColor: const Color(0xFFf1f5f9),
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
          ),
          validator: (value) {
            if (value == null || value.isEmpty) {
              return 'Please enter your password';
            }
            if (value.length < 6) {
              return 'Password must be at least 6 characters';
            }
            return null;
          },
          onFieldSubmitted: (_) => _signIn(),
        ),
      ],
    );
  }

  Widget _buildForgotPassword() {
    return Align(
      alignment: Alignment.centerRight,
      child: TextButton(
        onPressed: _navigateToForgotPassword,
        style: TextButton.styleFrom(
          padding: EdgeInsets.zero,
          minimumSize: Size.zero,
          tapTargetSize: MaterialTapTargetSize.shrinkWrap,
        ),
        child: Text(
          'Forgot password?',
          style: GoogleFonts.nunito(
            fontSize: 13,
            fontWeight: FontWeight.w600,
            color: AppTheme.primaryGreen,
          ),
        ),
      ),
    );
  }

  Widget _buildPowerfulSignInButton() {
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
            color: AppTheme.primaryGreen.withOpacity(0.5),
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
          onTap: _isLoading ? null : _signIn,
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
                        'Signing in...',
                        style: TextStyle(
                          color: Colors.white,
                          fontSize: 16,
                          fontWeight: FontWeight.w600,
                        ),
                      ),
                    ],
                  )
                : const Text(
                    'Sign In',
                    style: TextStyle(
                      color: Colors.white,
                      fontSize: 17,
                      fontWeight: FontWeight.w700,
                      letterSpacing: 0.5,
                    ),
                  ),
          ),
        ),
      ),
    );
  }

  Widget _buildOrDivider() {
    return Row(
      children: [
        Expanded(
          child: Container(
            height: 1,
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  Colors.transparent,
                  AppTheme.borderColor,
                ],
              ),
            ),
          ),
        ),
        Padding(
          padding: const EdgeInsets.symmetric(horizontal: 16),
          child: Text(
            'OR',
            style: GoogleFonts.nunito(
              fontSize: 12,
              fontWeight: FontWeight.w600,
              color: AppTheme.textLight,
            ),
          ),
        ),
        Expanded(
          child: Container(
            height: 1,
            decoration: BoxDecoration(
              gradient: LinearGradient(
                colors: [
                  AppTheme.borderColor,
                  Colors.transparent,
                ],
              ),
            ),
          ),
        ),
      ],
    );
  }

  Widget _buildCreateAccount() {
    return Center(
      child: GestureDetector(
        onTap: _navigateToRegister,
        child: RichText(
          textAlign: TextAlign.center,
          text: TextSpan(
            text: "Don't have an account? ",
            style: GoogleFonts.nunito(
              fontSize: 14,
              color: AppTheme.textGray,
              height: 1.5,
            ),
            children: [
              TextSpan(
                text: 'Create an account here',
                style: GoogleFonts.nunito(
                  fontSize: 14,
                  fontWeight: FontWeight.w700,
                  color: AppTheme.primaryGreen,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }

  Widget _buildFooter() {
    return Column(
      children: [
        Text(
          'Need help? Contact us at',
          style: GoogleFonts.nunito(
            fontSize: 13,
            color: Colors.white.withOpacity(0.85),
          ),
        ),
        const SizedBox(height: 4),
        GestureDetector(
          onTap: () {},
          child: Text(
            'info@zerixa.co.tz',
            style: GoogleFonts.nunito(
              fontSize: 13,
              fontWeight: FontWeight.w700,
              color: Colors.white,
            ),
          ),
        ),
        const SizedBox(height: 20),
        Text(
          '© 2026 SalamaPay. All rights reserved.',
          style: GoogleFonts.nunito(
            fontSize: 12,
            color: Colors.white.withOpacity(0.6),
          ),
        ),
      ],
    );
  }

  Widget _buildSocialIconsRow() {
    return Center(
      child: _buildSocialIconButton(
        onTap: () {},
        icon: _buildGoogleIcon(size: 28),
        bgColor: Colors.white,
      ),
    );
  }

  Widget _buildSocialIconButton({
    required VoidCallback onTap,
    required Widget icon,
    required Color bgColor,
  }) {
    return Container(
      width: 56,
      height: 56,
      decoration: BoxDecoration(
        color: bgColor,
        borderRadius: BorderRadius.circular(16),
        border: Border.all(
          color: const Color(0xFFe2e8f0),
          width: 1.5,
        ),
        boxShadow: [
          BoxShadow(
            color: Colors.black.withOpacity(0.1),
            blurRadius: 12,
            spreadRadius: 2,
            offset: const Offset(0, 4),
          ),
        ],
      ),
      child: Material(
        color: Colors.transparent,
        borderRadius: BorderRadius.circular(16),
        child: InkWell(
          onTap: onTap,
          borderRadius: BorderRadius.circular(16),
          child: Center(child: icon),
        ),
      ),
    );
  }

  Widget _buildGoogleIcon({double size = 32}) {
    return SizedBox(
      width: size,
      height: size,
      child: CustomPaint(
        painter: GoogleGIconPainter(),
      ),
    );
  }
}

class GoogleGIconPainter extends CustomPainter {
  @override
  void paint(Canvas canvas, Size size) {
    final center = Offset(size.width / 2, size.height / 2);
    final radius = size.width * 0.4;
    final strokeWidth = size.width * 0.12;

    // Draw G shape with segments
    final segments = [
      // Blue segment (top right)
      _Segment(center, radius, -0.8, 1.6, const Color(0xFF4285F4)),
      // Red segment (bottom right)
      _Segment(center, radius, 0.9, 1.2, const Color(0xFFEA4335)),
      // Yellow segment (bottom left)
      _Segment(center, radius, 2.2, 0.9, const Color(0xFFFBBC05)),
      // Green segment (top left)
      _Segment(center, radius, -2.5, 1.0, const Color(0xFF34A853)),
    ];

    for (final segment in segments) {
      final paint = Paint()
        ..color = segment.color
        ..style = PaintingStyle.stroke
        ..strokeWidth = strokeWidth
        ..strokeCap = StrokeCap.round;

      canvas.drawArc(
        Rect.fromCircle(center: segment.center, radius: segment.radius),
        segment.startAngle,
        segment.sweepAngle,
        false,
        paint,
      );
    }

    // Draw horizontal blue line (the crossbar of G)
    final linePaint = Paint()
      ..color = const Color(0xFF4285F4)
      ..style = PaintingStyle.stroke
      ..strokeWidth = strokeWidth
      ..strokeCap = StrokeCap.round;

    canvas.drawLine(
      Offset(center.dx, center.dy - radius * 0.1),
      Offset(center.dx + radius * 0.8, center.dy - radius * 0.1),
      linePaint,
    );
  }

  @override
  bool shouldRepaint(CustomPainter oldDelegate) => false;
}

class _Segment {
  final Offset center;
  final double radius;
  final double startAngle;
  final double sweepAngle;
  final Color color;

  _Segment(this.center, this.radius, this.startAngle, this.sweepAngle, this.color);
}
