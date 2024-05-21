const express = require("express");
const router = express.Router();
const LoginUserentry = require("../apiutils/callcode");

router.post("/login", LoginUserentry.calluser);

module.exports = router;