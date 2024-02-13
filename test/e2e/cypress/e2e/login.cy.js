describe('Login', () => {
    it('successfull', () => {
        cy.login('admin', 'admin');

        cy.get('.logo-lg > b').should('contain', 'Bolsa de Empleo');
    })

    it('error', () => {
        cy.login('admin', '1234');

        cy.get('input[name=password]').should('exist');
    })
})