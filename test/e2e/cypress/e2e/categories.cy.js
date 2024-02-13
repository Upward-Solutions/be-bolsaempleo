describe('Categorias', () => {
    it('Se visualizan las categorias correctamente', () => {
        cy.login('admin', 'admin')

        irACategorias()

        cy.get('h1').should('contain', 'Categorías')
    })


    it('Crear nueva categoria', () => {
        let nuevaCategoria = "Nueva Categoría";
        cy.login('admin', 'admin')
        irACategorias()
        abrirModalNuevaCategoria();

        crearNuevaCategoria(nuevaCategoria);

        cy.get('#DataTables_Table_0 tr').should('contain', nuevaCategoria);
        eliminarCategoria(nuevaCategoria);
    });

    it('Eliminar una categoria', () => {
        let nuevaCategoria = "Nueva Categoría";
        cy.login('admin', 'admin')
        irACategorias()
        abrirModalNuevaCategoria();
        crearNuevaCategoria(nuevaCategoria);

        eliminarCategoria(nuevaCategoria);

        cy.get('#DataTables_Table_0 tr').should('not.contain', nuevaCategoria);
    });

   it.skip('Editar una categoria', () => {
       let nuevaCategoria = "Nueva Categoría";
        cy.login('admin', 'admin')
        irACategorias()
        abrirModalNuevaCategoria();
        crearNuevaCategoria(nuevaCategoria);

        abrirModalEditarCategoria(nuevaCategoria)

        cy.get('#editName').type('Nuevo nombre', {force: true})

        eliminarCategoria(nuevaCategoria)
    });

    function abrirModalNuevaCategoria() {
        cy.get('.col-md-12 > .btn-default').click()
    }

    function irACategorias() {
        cy.goToSection("categories")
    }

    function crearNuevaCategoria(name) {
        cy.get('#addcategory > :nth-child(1) > .col-md-6 > #name').type(name)
        cy.get('#addcategory > :nth-child(2) > .col-lg-offset-2 > .btn').click()
    }

    function eliminarCategoria(name) {
        cy.get('#DataTables_Table_0 tr:contains("' + name + '")').find('.btn-danger').click();
    }

    function abrirModalEditarCategoria(name) {
        cy.get('#DataTables_Table_0 tr:contains("' + name + '")').find('.btn-warning').click();
    }
})

