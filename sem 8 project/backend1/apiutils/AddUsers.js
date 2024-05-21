const sql = require("mssql");
const dbConfig = require("../dbConfig");

async function postAddUser(res, req){
    try{
        await sql.connect(dbConfig);
        const request = new sql.Request();
        const result = await request.execute("AddUser");
        console.log("Result", result);
    }catch(error){

    };
};

module.exports = postAddUser;