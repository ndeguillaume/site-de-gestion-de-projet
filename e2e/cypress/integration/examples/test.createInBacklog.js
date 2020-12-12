context('Create in backlog', () => {
    // Checks the db is empty
    before(() => {
        cy.visit('/models/issue/views/Backlog.php').then(() => {

            cy.task('queryDb', "SELECT 1 AS Output FROM `project` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })

            cy.task('queryDb', "SELECT 1 AS Output FROM `sprint` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `issue` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task_todo` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task_inprogress` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task_done` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task_issues_dependency` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `task_dependency` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `test_scenario` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `test` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `test_history` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `user_documentation` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
            cy.task('queryDb', "SELECT 1 AS Output FROM `install_documentation` LIMIT 1;")
                .then(results => {
                    expect(results).to.be.empty;
                })
        })
    })

    beforeEach(() => {
        cy.visit('/models/issue/views/Backlog.php');
    })

    it('init', () => {
        cy.get('.sprint').should('have.length', 1);
        cy.get('.sprint ul').find('li').should('have.length', 0);
    })

    it('create a new sprint', () => {
        cy.get('#backlog').contains("Ajouter un sprint").click()
        cy.get('.sprint').should('have.length', 2)
        cy.task('queryDb', "SELECT * FROM `sprint`;")
            .then(results => {
                expect(results).not.to.be.empty;
                expect(results).to.have.lengthOf(1);
            });

    })

    it('create an issue in the backlog', () => {
        cy.get('#backlog').contains('+ Ajouter une issue').click();
        cy.get('#new-issue').click();
        cy.get('#new-issue textarea')
            .type('nouvelle issue backlog').should('have.value', 'nouvelle issue backlog')
            .type('{enter}')
        cy.get("#backlog .issue-title").last().should(($issue) => {
            expect($issue).to.have.text('nouvelle issue backlog');
        })
        cy.get('#backlog').find('li').should('have.length', 1)
        cy.task('queryDb', "SELECT * FROM `issue`;")
            .then(results => {
                expect(results).not.to.be.empty;
                expect(results).to.have.lengthOf(1);
            });
    })

    it('create an issue in the first non ended sprint', () => {
        cy.get('.sprint').first().find('.add-issue').click();
        cy.get('#new-issue').click();
        cy.get('#new-issue textarea')
            .type('nouvelle issue sprint 1').should('have.value', 'nouvelle issue sprint 1')
            .type('{enter}')
        cy.get('.sprint').first().find('li').should('have.length', 1)
        cy.task('queryDb', "SELECT * FROM `issue`;")
            .then(results => {
                expect(results).not.to.be.empty;
                expect(results).to.have.lengthOf(2);
            });
    })

    after(() => {
        cy.task('queryDb', "TRUNCATE TABLE `project`");
        cy.task('queryDb', "TRUNCATE TABLE `issue`");
        cy.task('queryDb', "TRUNCATE TABLE `sprint`");
        cy.task('queryDb', "TRUNCATE TABLE `task`");
        cy.task('queryDb', "TRUNCATE TABLE `task_todo`");
        cy.task('queryDb', "TRUNCATE TABLE `task_inprogress`");
        cy.task('queryDb', "TRUNCATE TABLE `task_done`");
    })
})

