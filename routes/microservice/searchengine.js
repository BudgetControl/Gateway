const express = require('express');
const router = express.Router();
const SearchEngineController = require('../../controllers/SearchEngineController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');
const CachingMiddleware = require('../../middleware/CachingMiddleware');

router.use(AuthMiddleware);

router.post('/find', CachingMiddleware(10), SearchEngineController.find);

module.exports = router;
