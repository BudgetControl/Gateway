const express = require('express');
const router = express.Router();
const AuthController = require('../../controllers/AuthController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.get('/auth/check', AuthController.check);
router.get('/auth/user-info', AuthController.getUserInfo);
router.post('/auth/sign-up', AuthController.signUp);
router.get('/auth/confirm/:token', AuthController.confirmToken);
router.post('/auth/authenticate', AuthController.authenticate);
router.post('/auth/reset-password', AuthController.sendResetPasswordMail);
router.post('/auth/verify-email', AuthController.sendVerifyEmail);
router.put('/auth/reset-password/:token', AuthController.resetPassword);
router.get('/auth/authenticate/:provider', AuthController.authenticateProvider);
router.get('/auth/authenticate/token/:provider', AuthController.providerToken);
router.get('/auth/logout', AuthController.logout);
router.get('/auth/user-info/by-email/:email', AuthMiddleware, AuthController.getUserInfoByEmail);
router.post('/auth/:userUuid/finalize/sign-up', AuthController.finalizeSignUp);

module.exports = router;
