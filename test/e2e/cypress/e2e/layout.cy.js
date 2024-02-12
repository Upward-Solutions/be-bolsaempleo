describe('Layout test', () => {
    context('WEB', () => {
        it('Título', () => {
            cy.get('.layout-title').should('contain', 'Bienestar Estudiantil')
        })

        it('Menú', () => {
            cy.get('[href="./?view=vacantes"]').should('contain', 'Vacantes')
        })

        it('Footer', () => {
            cy.get('.layout-footer-text').should('contain', 'Realizado por')
            cy.get('.layout-footer-text').should('contain', '2024')
            cy.get('.layout-footer-text > a').should('contain', 'Bienestar Estudiantil')
        })
    })

    context('MOBILE', () => {
        it('Título', () => {
            cy.get('.layout-title').should('contain', 'Bienestar Estudiantil')
        })

        it('Menú', () => {
            cy.get('[href="./?view=vacantes"]').should('contain', 'Vacantes')
        })

        it('Footer', () => {
            cy.get('.layout-footer-text').should('contain', 'Realizado por')
            cy.get('.layout-footer-text').should('contain', '2024')
            cy.get('.layout-footer-text > a').should('contain', 'Bienestar Estudiantil')
        })

        beforeEach(() => {
            cy.viewport('iphone-xr')
        })
    })

    beforeEach(() => {
        cy.visit(URL_BASE)
    })

    const URL_BASE = 'http://app:8080'
})
