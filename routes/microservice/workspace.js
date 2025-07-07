const express = require('express');
const router = express.Router();
const WorkspaceController = require('../../controllers/WorkspaceController');
const AuthMiddleware = require('../../middleware/AuthMiddleware');

router.use(AuthMiddleware);

router.get('/workspace/list', WorkspaceController.list);
router.get('/workspace/by-user/list', WorkspaceController.listByUser);
router.get('/workspace/last', WorkspaceController.last);
router.get('/workspace/:id', WorkspaceController.show);
router.post('/workspace/create', WorkspaceController.create);
router.put('/workspace/update/:id', WorkspaceController.update);
router.patch('/workspace/activate/:id', WorkspaceController.activate);
router.delete('/workspace/delete/:id', WorkspaceController.delete);

module.exports = router;
