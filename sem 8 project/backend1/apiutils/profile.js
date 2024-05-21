const con = require("../dbConfig");

async function profilepass(req, res) {
  const { username, newPassword } = req.body;

  try {
    // Check if username exists
    con.query('SELECT * FROM users WHERE username = ?', [username], function(error, results) {
      if (error) {
        console.error("Error querying the database:", error);
        return res.status(500).json({ error: "Server error" });
      }

      // If username doesn't exist, return an error
      if (!results || results.length === 0) {
        return res.status(404).json({ message: "Username not found" });
      }

      // Update password
      con.query('UPDATE users SET password = ? WHERE username = ?', [newPassword, username], function(error, results) {
        if (error) {
          console.error("Error updating password:", error);
          return res.status(500).json({ error: "Server error" });
        }
        
        return res.status(200).json({ message: "Password updated successfully" });
      });
    });
  } catch (error) {
    console.error("Error updating password:", error);
    return res.status(500).json({ error: "Server error" });
  }
}

module.exports = {
  profilepass,
};
