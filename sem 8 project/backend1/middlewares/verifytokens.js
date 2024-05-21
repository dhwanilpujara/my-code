// middlewares/authMiddleware.js
const jwt = require("jsonwebtoken");

const secretKey = "Karm_45*&uesih9*&#@H#12345"; // Replace with your secret key

function verifyToken(req, res, next) {
  const token = req.header("Authorization");

  // Check if the token is missing
  if (!token) {
    return res.status(402).json({ message: "Unauthorized - Token is missing" });
  }

  try {
    // Verify the token
    const decoded = jwt.verify(token.replace("Bearer ", ""), secretKey);
    req.user = decoded.user;
    next();
  } catch (error) {
    return res.status(401).json({ message: "Unauthorized - Token is invalid" });
  }
}
module.exports = {
  verifyToken,
};
