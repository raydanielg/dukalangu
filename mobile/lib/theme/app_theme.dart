import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AppTheme {
  // Primary Colors - Green Theme
  static const Color primaryGreen = Color(0xFF16a34a);
  static const Color primaryGreenDark = Color(0xFF15803d);
  static const Color primaryGreenLight = Color(0xFF22c55e);
  static const Color primaryGreenDarker = Color(0xFF14532d);
  
  // Background Colors
  static const Color backgroundLight = Color(0xFFf9fafb);
  static const Color backgroundWhite = Color(0xFFFFFFFF);
  static const Color backgroundGradientStart = Color(0xFF15803d);
  static const Color backgroundGradientMid = Color(0xFF166534);
  static const Color backgroundGradientEnd = Color(0xFF14532d);
  
  // Text Colors
  static const Color textDark = Color(0xFF1f2937);
  static const Color textGray = Color(0xFF6b7280);
  static const Color textLight = Color(0xFF9ca3af);
  
  // Border & Shadow
  static const Color borderColor = Color(0xFFe5e7eb);
  static Color shadowGreen = const Color(0xFF16a34a).withOpacity(0.15);
  
  // Error Colors
  static const Color errorColor = Color(0xFFef4444);
  
  static ThemeData get lightTheme {
    return ThemeData(
      useMaterial3: true,
      brightness: Brightness.light,
      primaryColor: primaryGreen,
      scaffoldBackgroundColor: backgroundWhite,
      
      // Color Scheme
      colorScheme: const ColorScheme.light(
        primary: primaryGreen,
        secondary: primaryGreenLight,
        surface: backgroundWhite,
        background: backgroundLight,
        error: errorColor,
        onPrimary: Colors.white,
        onSecondary: Colors.white,
        onSurface: textDark,
        onBackground: textDark,
        onError: Colors.white,
      ),
      
      // Text Theme
      textTheme: GoogleFonts.nunitoTextTheme().copyWith(
        displayLarge: GoogleFonts.nunito(
          fontSize: 32,
          fontWeight: FontWeight.bold,
          color: textDark,
        ),
        displayMedium: GoogleFonts.nunito(
          fontSize: 24,
          fontWeight: FontWeight.bold,
          color: textDark,
        ),
        displaySmall: GoogleFonts.nunito(
          fontSize: 20,
          fontWeight: FontWeight.w600,
          color: textDark,
        ),
        headlineMedium: GoogleFonts.nunito(
          fontSize: 18,
          fontWeight: FontWeight.w600,
          color: textDark,
        ),
        bodyLarge: GoogleFonts.nunito(
          fontSize: 16,
          fontWeight: FontWeight.normal,
          color: textDark,
        ),
        bodyMedium: GoogleFonts.nunito(
          fontSize: 14,
          fontWeight: FontWeight.normal,
          color: textGray,
        ),
        bodySmall: GoogleFonts.nunito(
          fontSize: 12,
          fontWeight: FontWeight.normal,
          color: textLight,
        ),
        labelLarge: GoogleFonts.nunito(
          fontSize: 14,
          fontWeight: FontWeight.w600,
          color: primaryGreen,
        ),
      ),
      
      // Input Decoration Theme
      inputDecorationTheme: InputDecorationTheme(
        filled: true,
        fillColor: backgroundWhite,
        contentPadding: const EdgeInsets.symmetric(horizontal: 16, vertical: 16),
        border: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: borderColor),
        ),
        enabledBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: borderColor),
        ),
        focusedBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: primaryGreen, width: 2),
        ),
        errorBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: errorColor),
        ),
        focusedErrorBorder: OutlineInputBorder(
          borderRadius: BorderRadius.circular(12),
          borderSide: const BorderSide(color: errorColor, width: 2),
        ),
        prefixIconColor: textLight,
        suffixIconColor: textGray,
        hintStyle: GoogleFonts.nunito(
          fontSize: 14,
          color: textLight,
        ),
      ),
      
      // Elevated Button Theme
      elevatedButtonTheme: ElevatedButtonThemeData(
        style: ElevatedButton.styleFrom(
          backgroundColor: primaryGreen,
          foregroundColor: Colors.white,
          elevation: 4,
          shadowColor: primaryGreen.withOpacity(0.4),
          padding: const EdgeInsets.symmetric(vertical: 16, horizontal: 24),
          shape: RoundedRectangleBorder(
            borderRadius: BorderRadius.circular(12),
          ),
          textStyle: GoogleFonts.nunito(
            fontSize: 16,
            fontWeight: FontWeight.w600,
          ),
        ),
      ),
      
      // Text Button Theme
      textButtonTheme: TextButtonThemeData(
        style: TextButton.styleFrom(
          foregroundColor: primaryGreen,
          textStyle: GoogleFonts.nunito(
            fontSize: 14,
            fontWeight: FontWeight.w600,
          ),
        ),
      ),
      
      // Card Theme
      cardTheme: CardThemeData(
        elevation: 0,
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(16),
          side: const BorderSide(color: borderColor),
        ),
        color: backgroundWhite,
      ),
      
      // AppBar Theme
      appBarTheme: AppBarTheme(
        elevation: 0,
        centerTitle: true,
        backgroundColor: Colors.transparent,
        foregroundColor: textDark,
        titleTextStyle: GoogleFonts.nunito(
          fontSize: 18,
          fontWeight: FontWeight.w600,
          color: textDark,
        ),
      ),
    );
  }
}
