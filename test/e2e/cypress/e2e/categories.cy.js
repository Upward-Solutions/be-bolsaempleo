describe.skip('Categorias', () => {
    it('CREATE - Crear nueva categoria', () => {
        crearCategoria(nuevaCategoria)

        cy.get('#DataTables_Table_0 tr').should('contain', nuevaCategoria)
        eliminarCategoria(nuevaCategoria)
    })

    it('READ - Se visualizan las categorias correctamente', () => {
        cy.get('h1').should('contain', 'Categorías')
    })

    it('UPDATE - Editar una categoria', () => {
        crearCategoria(nuevaCategoria)
        abrirModalEditarCategoria(nuevaCategoria)
        editarCategoria();

        eliminarCategoria(nuevoValor)
    })

    it('DELETE - Eliminar una categoria', () => {
        crearCategoria(nuevaCategoria)

        eliminarCategoria(nuevaCategoria)

        cy.get('#DataTables_Table_0 tr').should('not.contain', nuevaCategoria)
    })

    beforeEach(() => {
        cy.login('admin', 'admin')
        cy.goToSection("categories")
    })

    const nuevaCategoria = "Nueva Categoría"
    const nuevoValor = 'Nuevo valor'

    function abrirModalNuevaCategoria() {
        cy.get('.col-md-12 > .btn-default').click()
    }

    function crearNuevaCategoria(name) {
        cy.get('#addcategory > :nth-child(1) > .col-md-6 > #name').type(name)
        cy.get('#addcategory > :nth-child(2) > .col-lg-offset-2 > .btn').click()
    }

    function eliminarCategoria(name) {
        cy.get('#DataTables_Table_0 tr:contains("' + name + '")').find('.btn-danger').click()
    }

    function abrirModalEditarCategoria(name) {
        cy.get('#DataTables_Table_0 tr:contains("' + name + '")').find('.btn-warning').click()
    }

    function crearCategoria(nuevaCategoria) {
        abrirModalNuevaCategoria()
        crearNuevaCategoria(nuevaCategoria)
    }

    function editarCategoria() {
        cy.get('#editModal').find('#newName').clear().type(nuevoValor)
        cy.get('#editModal').find('.btn').click()
    }
})

