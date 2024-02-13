describe('Vacantes', () => {
    it('Se visualizan las vacantes correctamente', () => {
        cy.login('admin', 'admin')

        cy.goToSection("jobs")

        cy.get('h1').should('contain', 'Vacantes de Trabajo')
    })

})