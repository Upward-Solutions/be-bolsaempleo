Cypress.Commands.add('login', (username, passowrd) =>{
    cy.visit('http://localhost:8080/admin/')
    cy.get('input[name=username]').type(username)
    cy.get('input[name=password]').type(passowrd)
    cy.get('button[type=submit]').click()
})
