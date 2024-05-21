const jwt = require("jsonwebtoken");
const con = require("../dbConfig");

async function loginUser(req, res) {
  const { username, password } = req.body;

  console.log("Data", username, password);

  try {
    // Query the database to check if the user exists and the password is correct
    con.query('SELECT * FROM users WHERE username = ?', [username], function(error, results) {
      if (error) {
        console.error("Error querying the database:", error);
        return res.status(500).json({ error: "Server error" });
      }
      console.log("Retrivee query trault",results[0]);
      // Check if user exists
      if (!results || results.length === 0) {
        return res.status(400).json({ message: "User not found" });
      }

      // Retrieve user details from the query result
      const user = results[0];

      // Check if the provided password matches the user's password
      if (user.password !== password) {
        console.log("error");
        return res.status(402).json({ message: "Invalid password" });
      }

      // Generate JWT token
      const token = jwt.sign(
        {
          username: user.username,
        },
        "Karm_45*&uesih9*&#@H#12345",
        { expiresIn: "30m" }
      );

      // Send response with token and user information
      return res
        .cookie("token", token, { httpOnly: true, maxAge: 1800000 })
        .json({
          message: "Login successful",
          username: user.username,
          token: token,
        });
    });
  } catch (error) {
    // Handle errors
    console.error("Error logging in:", error);
    return res.status(500).json({ error: "Server error" });
  }
}

module.exports = {
  loginUser,
};
