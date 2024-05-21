const con = require("../dbConfig");

async function signupUser(req, res) {
  const { username, password } = req.body;

  try {
    // Check if username already exists
    con.query('SELECT * FROM users WHERE username = ?', [username], function(error, results) {
      if (error) {
        console.error("Error querying the database:", error);
        return res.status(500).json({ error: "Server error" });
      }

      // If username already exists, return an error
      if (results && results.length > 0) {
        return res.status(400).json({ message: "Username already exists" });
      }

      // Insert the new user into the database
      con.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], function(error, results) {
        if (error) {
          console.error("Error inserting into the database:", error);
          return res.status(500).json({ error: "Server error" });
        }
        
        return res.status(200).json({ message: "Signup successful" });
      });
    });
  } catch (error) {
    console.error("Error signing up:", error);
    return res.status(500).json({ error: "Server error" });
  }
}

module.exports = {
  signupUser,
};
