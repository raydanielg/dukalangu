import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import '../theme/app_theme.dart';
import '../services/api_service.dart';

class HelpCenterScreen extends StatefulWidget {
  const HelpCenterScreen({super.key});

  @override
  State<HelpCenterScreen> createState() => _HelpCenterScreenState();
}

class _HelpCenterScreenState extends State<HelpCenterScreen> {
  final _apiService = ApiService();
  List<dynamic> _faqs = [];
  bool _isLoading = true;
  String _searchQuery = '';

  @override
  void initState() {
    super.initState();
    _loadFaqs();
  }

  Future<void> _loadFaqs() async {
    // Demo FAQs - in real app, fetch from API
    await Future.delayed(const Duration(milliseconds: 500));
    setState(() {
      _faqs = [
        {
          'id': 1,
          'question': 'How do I add a product to my store?',
          'answer': 'Go to Store tab, tap the + button, fill in product details (name, price, stock), and save.',
          'category': 'Products',
        },
        {
          'id': 2,
          'question': 'How do I receive payments?',
          'answer': 'Customers can pay via mobile money, bank transfer, or cash. All payments are tracked in your Orders section.',
          'category': 'Payments',
        },
        {
          'id': 3,
          'question': 'How do I share my store link?',
          'answer': 'Go to Store tab > QR Code, scan the code or tap Share button to send your store link to customers.',
          'category': 'Store',
        },
        {
          'id': 4,
          'question': 'What happens when stock runs out?',
          'answer': 'Your product will show "Out of Stock" to customers. You\'ll get a notification to restock.',
          'category': 'Products',
        },
        {
          'id': 5,
          'question': 'How do I cancel an order?',
          'answer': 'Go to Orders, find the order, tap on it, and select Cancel Order.',
          'category': 'Orders',
        },
        {
          'id': 6,
          'question': 'Is there a fee for using SalamaPay?',
          'answer': 'SalamaPay charges a small commission per successful sale. Check Pricing in About section.',
          'category': 'Payments',
        },
      ];
      _isLoading = false;
    });
  }

  List<dynamic> get _filteredFaqs {
    if (_searchQuery.isEmpty) return _faqs;
    return _faqs.where((faq) {
      final question = faq['question'].toString().toLowerCase();
      final answer = faq['answer'].toString().toLowerCase();
      return question.contains(_searchQuery.toLowerCase()) ||
             answer.contains(_searchQuery.toLowerCase());
    }).toList();
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
          child: _isLoading
              ? const Center(
                  child: CircularProgressIndicator(
                    valueColor: AlwaysStoppedAnimation<Color>(Colors.white),
                  ),
                )
              : Column(
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
                          Expanded(
                            child: Text(
                              'Help Center',
                              style: GoogleFonts.nunito(
                                fontSize: 24,
                                fontWeight: FontWeight.bold,
                                color: Colors.white,
                              ),
                            ),
                          ),
                        ],
                      ),
                    ),

                    // Search
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 20),
                      child: Container(
                        padding: const EdgeInsets.symmetric(horizontal: 16),
                        decoration: BoxDecoration(
                          color: Colors.white.withOpacity(0.2),
                          borderRadius: BorderRadius.circular(12),
                        ),
                        child: TextField(
                          onChanged: (value) => setState(() => _searchQuery = value),
                          style: GoogleFonts.nunito(color: Colors.white),
                          decoration: InputDecoration(
                            hintText: 'Search for help...',
                            hintStyle: GoogleFonts.nunito(
                              color: Colors.white.withOpacity(0.7),
                            ),
                            prefixIcon: Icon(
                              Icons.search,
                              color: Colors.white.withOpacity(0.7),
                            ),
                            border: InputBorder.none,
                          ),
                        ),
                      ),
                    ),

                    const SizedBox(height: 20),

                    // Quick Links
                    Padding(
                      padding: const EdgeInsets.symmetric(horizontal: 20),
                      child: Row(
                        children: [
                          _buildQuickLink('Getting Started', Icons.rocket_launch),
                          const SizedBox(width: 12),
                          _buildQuickLink('Payments', Icons.payments),
                          const SizedBox(width: 12),
                          _buildQuickLink('Orders', Icons.shopping_bag),
                        ],
                      ),
                    ),

                    const SizedBox(height: 20),

                    // FAQs
                    Expanded(
                      child: Container(
                        margin: const EdgeInsets.symmetric(horizontal: 20),
                        decoration: BoxDecoration(
                          color: Colors.white,
                          borderRadius: BorderRadius.circular(24),
                        ),
                        child: _filteredFaqs.isEmpty
                            ? Center(
                                child: Text(
                                  'No results found',
                                  style: GoogleFonts.nunito(
                                    color: AppTheme.textGray,
                                  ),
                                ),
                              )
                            : ListView.builder(
                                padding: const EdgeInsets.all(16),
                                itemCount: _filteredFaqs.length,
                                itemBuilder: (context, index) {
                                  final faq = _filteredFaqs[index];
                                  return _buildFaqItem(faq);
                                },
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

  Widget _buildQuickLink(String label, IconData icon) {
    return Expanded(
      child: Container(
        padding: const EdgeInsets.symmetric(vertical: 12),
        decoration: BoxDecoration(
          color: Colors.white.withOpacity(0.15),
          borderRadius: BorderRadius.circular(12),
          border: Border.all(color: Colors.white.withOpacity(0.3)),
        ),
        child: Column(
          children: [
            Icon(icon, color: Colors.white, size: 24),
            const SizedBox(height: 4),
            Text(
              label,
              style: GoogleFonts.nunito(
                color: Colors.white,
                fontSize: 12,
                fontWeight: FontWeight.w500,
              ),
            ),
          ],
        ),
      ),
    );
  }

  Widget _buildFaqItem(Map<String, dynamic> faq) {
    return Card(
      margin: const EdgeInsets.only(bottom: 12),
      elevation: 0,
      color: const Color(0xFFf8fafc),
      shape: RoundedRectangleBorder(
        borderRadius: BorderRadius.circular(12),
      ),
      child: ExpansionTile(
        title: Text(
          faq['question'],
          style: GoogleFonts.nunito(
            fontWeight: FontWeight.w600,
            fontSize: 15,
          ),
        ),
        subtitle: Text(
          faq['category'],
          style: GoogleFonts.nunito(
            fontSize: 12,
            color: AppTheme.primaryGreen,
          ),
        ),
        children: [
          Padding(
            padding: const EdgeInsets.all(16),
            child: Text(
              faq['answer'],
              style: GoogleFonts.nunito(
                fontSize: 14,
                color: AppTheme.textGray,
                height: 1.5,
              ),
            ),
          ),
        ],
      ),
    );
  }
}
