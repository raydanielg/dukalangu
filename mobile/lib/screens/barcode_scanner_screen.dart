import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../theme/app_theme.dart';
import '../services/api_service.dart';
import 'product_detail_screen.dart';

class BarcodeScannerScreen extends StatefulWidget {
  const BarcodeScannerScreen({super.key});

  @override
  State<BarcodeScannerScreen> createState() => _BarcodeScannerScreenState();
}

class _BarcodeScannerScreenState extends State<BarcodeScannerScreen> {
  final _apiService = ApiService();
  final _barcodeController = TextEditingController();
  bool _isLoading = false;
  bool _isScanning = false;

  @override
  void dispose() {
    _barcodeController.dispose();
    super.dispose();
  }

  Future<void> _scanBarcode() async {
    setState(() => _isScanning = true);

    // Simulate scanning delay
    await Future.delayed(const Duration(seconds: 2));

    // For demo, use a sample barcode
    final scannedCode = 'PROD-${DateTime.now().millisecondsSinceEpoch % 10000}';

    setState(() {
      _barcodeController.text = scannedCode;
      _isScanning = false;
    });

    _searchProduct();
  }

  Future<void> _searchProduct() async {
    if (_barcodeController.text.isEmpty) return;

    setState(() => _isLoading = true);

    // In real implementation, this would search by barcode
    // For now, we'll search by ID or name
    final result = await _apiService.getStoreProducts();

    setState(() => _isLoading = false);

    if (result['success']) {
      final products = result['data']?['products'] ?? [];

      // Try to find product by ID or show first one for demo
      final product = products.firstWhere(
        (p) => p['id'].toString() == _barcodeController.text ||
               p['name'].toString().toLowerCase().contains(_barcodeController.text.toLowerCase()),
        orElse: () => null,
      );

      if (product != null && mounted) {
        Navigator.of(context).pushReplacement(
          MaterialPageRoute(
            builder: (_) => ProductDetailScreen(product: product),
          ),
        );
      } else {
        _showNotFoundDialog();
      }
    }
  }

  void _showNotFoundDialog() {
    showDialog(
      context: context,
      builder: (context) => AlertDialog(
        shape: RoundedRectangleBorder(borderRadius: BorderRadius.circular(20)),
        title: Row(
          children: [
            const Icon(Icons.error_outline, color: AppTheme.errorColor, size: 32),
            const SizedBox(width: 12),
            Text(
              'Product Not Found',
              style: GoogleFonts.nunito(fontWeight: FontWeight.bold),
            ),
          ],
        ),
        content: Text(
          'No product found with code: ${_barcodeController.text}',
          style: GoogleFonts.nunito(),
        ),
        actions: [
          TextButton(
            onPressed: () => Navigator.pop(context),
            child: Text(
              'Try Again',
              style: GoogleFonts.nunito(color: AppTheme.primaryGreen),
            ),
          ),
          ElevatedButton(
            onPressed: () {
              Navigator.pop(context);
              Navigator.pop(context);
            },
            style: ElevatedButton.styleFrom(
              backgroundColor: AppTheme.primaryGreen,
            ),
            child: Text(
              'Go Back',
              style: GoogleFonts.nunito(color: Colors.white),
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
                      'Scan Barcode',
                      style: GoogleFonts.nunito(
                        fontSize: 24,
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                      ),
                    ),
                  ],
                ),
              ),

              // Scanner Area
              Expanded(
                child: Container(
                  margin: const EdgeInsets.symmetric(horizontal: 20),
                  decoration: BoxDecoration(
                    color: Colors.white,
                    borderRadius: BorderRadius.circular(24),
                    boxShadow: [
                      BoxShadow(
                        color: Colors.black.withOpacity(0.2),
                        blurRadius: 30,
                        spreadRadius: 8,
                      ),
                    ],
                  ),
                  child: Column(
                    children: [
                      // Scanner View
                      Expanded(
                        flex: 3,
                        child: Container(
                          margin: const EdgeInsets.all(20),
                          decoration: BoxDecoration(
                            color: Colors.black,
                            borderRadius: BorderRadius.circular(20),
                            border: Border.all(
                              color: AppTheme.primaryGreen,
                              width: 2,
                            ),
                          ),
                          child: ClipRRect(
                            borderRadius: BorderRadius.circular(18),
                            child: Stack(
                              alignment: Alignment.center,
                              children: [
                                // Camera placeholder
                                Container(
                                  color: Colors.black87,
                                  child: Center(
                                    child: _isScanning
                                        ? Column(
                                            mainAxisSize: MainAxisSize.min,
                                            children: [
                                              const CircularProgressIndicator(
                                                color: Colors.white,
                                              ),
                                              const SizedBox(height: 16),
                                              Text(
                                                'Scanning...',
                                                style: GoogleFonts.nunito(
                                                  color: Colors.white,
                                                  fontSize: 16,
                                                ),
                                              ),
                                            ],
                                          )
                                        : Column(
                                            mainAxisSize: MainAxisSize.min,
                                            children: [
                                              Icon(
                                                Icons.qr_code_scanner,
                                                size: 80,
                                                color: Colors.white.withOpacity(0.5),
                                              ),
                                              const SizedBox(height: 16),
                                              Text(
                                                'Position barcode within frame',
                                                style: GoogleFonts.nunito(
                                                  color: Colors.white.withOpacity(0.7),
                                                  fontSize: 14,
                                                ),
                                              ),
                                            ],
                                          ),
                                  ),
                                ),

                                // Scan frame overlay
                                if (!_isScanning)
                                  Container(
                                    width: 250,
                                    height: 150,
                                    decoration: BoxDecoration(
                                      border: Border.all(
                                        color: AppTheme.primaryGreen,
                                        width: 3,
                                      ),
                                      borderRadius: BorderRadius.circular(12),
                                    ),
                                  ),

                                // Corner markers
                                if (!_isScanning)
                                  Positioned(
                                    top: 40,
                                    left: 40,
                                    child: _buildCorner(),
                                  ),
                                if (!_isScanning)
                                  Positioned(
                                    top: 40,
                                    right: 40,
                                    child: RotatedBox(
                                      quarterTurns: 1,
                                      child: _buildCorner(),
                                    ),
                                  ),
                                if (!_isScanning)
                                  Positioned(
                                    bottom: 40,
                                    left: 40,
                                    child: RotatedBox(
                                      quarterTurns: 3,
                                      child: _buildCorner(),
                                    ),
                                  ),
                                if (!_isScanning)
                                  Positioned(
                                    bottom: 40,
                                    right: 40,
                                    child: RotatedBox(
                                      quarterTurns: 2,
                                      child: _buildCorner(),
                                    ),
                                  ),
                              ],
                            ),
                          ),
                        ),
                      ),

                      // Manual Entry
                      Padding(
                        padding: const EdgeInsets.all(20),
                        child: Column(
                          children: [
                            Text(
                              'Or enter code manually:',
                              style: GoogleFonts.nunito(
                                fontSize: 14,
                                color: AppTheme.textGray,
                              ),
                            ),
                            const SizedBox(height: 12),
                            TextField(
                              controller: _barcodeController,
                              style: GoogleFonts.nunito(),
                              decoration: InputDecoration(
                                hintText: 'Enter product code',
                                prefixIcon: const Icon(
                                  Icons.search,
                                  color: AppTheme.primaryGreen,
                                ),
                                filled: true,
                                fillColor: const Color(0xFFf1f5f9),
                                border: OutlineInputBorder(
                                  borderRadius: BorderRadius.circular(12),
                                  borderSide: BorderSide.none,
                                ),
                                focusedBorder: OutlineInputBorder(
                                  borderRadius: BorderRadius.circular(12),
                                  borderSide: const BorderSide(
                                    color: AppTheme.primaryGreen,
                                    width: 2,
                                  ),
                                ),
                              ),
                            ),
                            const SizedBox(height: 16),
                            SizedBox(
                              width: double.infinity,
                              height: 56,
                              child: ElevatedButton.icon(
                                onPressed: _isLoading ? null : _searchProduct,
                                icon: _isLoading
                                    ? const SizedBox(
                                        width: 20,
                                        height: 20,
                                        child: CircularProgressIndicator(
                                          strokeWidth: 2,
                                          color: Colors.white,
                                        ),
                                      )
                                    : const Icon(Icons.search),
                                label: Text(
                                  _isLoading ? 'Searching...' : 'Search Product',
                                  style: GoogleFonts.nunito(
                                    fontSize: 16,
                                    fontWeight: FontWeight.bold,
                                  ),
                                ),
                                style: ElevatedButton.styleFrom(
                                  backgroundColor: AppTheme.primaryGreen,
                                  foregroundColor: Colors.white,
                                  shape: RoundedRectangleBorder(
                                    borderRadius: BorderRadius.circular(12),
                                  ),
                                ),
                              ),
                            ),
                          ],
                        ),
                      ),
                    ],
                  ),
                ),
              ),

              const SizedBox(height: 20),
            ],
          ),
        ),
      ),
      floatingActionButton: FloatingActionButton.extended(
        onPressed: _isScanning ? null : _scanBarcode,
        backgroundColor: AppTheme.primaryGreen,
        icon: const Icon(Icons.camera_alt),
        label: Text(
          'Scan',
          style: GoogleFonts.nunito(fontWeight: FontWeight.bold),
        ),
      ),
      floatingActionButtonLocation: FloatingActionButtonLocation.centerFloat,
    );
  }

  Widget _buildCorner() {
    return Container(
      width: 30,
      height: 30,
      decoration: BoxDecoration(
        border: Border(
          top: const BorderSide(color: AppTheme.primaryGreen, width: 4),
          left: const BorderSide(color: AppTheme.primaryGreen, width: 4),
        ),
        borderRadius: BorderRadius.circular(4),
      ),
    );
  }
}
