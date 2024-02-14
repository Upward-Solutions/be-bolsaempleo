Cypress.Commands.add('login', (username, passowrd) =>{
    cy.visit('/admin/')
    cy.get('input[name=username]').type(username)
    cy.get('input[name=password]').type(passowrd)
    cy.get('button[type=submit]').click()
})

Cypress.Commands.add('goToSection', name => {
    cy.get(`ul.sidebar-menu li a[href*="${name}"]`).click();
});
