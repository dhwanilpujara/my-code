const express = require("express");
const router = express.Router();
const LoginUserentry = require("../apiutils/loginuser");

router.post("/login", LoginUserentry.loginUser);

module.exports = router;