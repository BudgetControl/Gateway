const express = require('express');
const router = express.Router();
const CoreController = require('../../controllers/CoreController');
const CachingMiddleware = require('../../middleware/CachingMiddleware');

router.use(CachingMiddleware(43200));

router.get('/payment-types', CoreController.paymentTypes);
router.get('/currencies', CoreController.currencies);
router.get('/categories', CoreController.categories);
router.get('/categories-subcategories', CoreController.categoriesSubcategories);

module.exports = router;
