const mysql = require('mysql')
function queryTestDb(query, config) {
  // creates a new mysql connection using credentials from cypress.json env's
  const connection = mysql.createConnection({
    host: "database-test",
    user: "user",
    password: "",
    database: "CDP_TEST"
  })
  // start connection to db
  connection.connect()
  // exec query + disconnect to db as a Promise
  return new Promise((resolve, reject) => {
   connection.query(query, (error, results) => {
      if (error) reject(error)
      else {
        connection.end()
        // console.log(results)
        return resolve(results)
      }
    })
  })
}

module.exports = (on, config) => {
  // Usage: cy.task('queryDb', query)
  on('task', {
    queryDb: query => {
      return queryTestDb(query, config)
    },
  })
}
