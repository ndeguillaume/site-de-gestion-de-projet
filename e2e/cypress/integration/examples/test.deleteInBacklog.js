context('Delete in backlog', () => {
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


    it('delete a new sprint', () => {
        cy.task('queryDb', "INSERT INTO `sprint` (project_id, title) VALUES('1','Sprint to delete');")
            .then(() => {
                cy.reload();
                cy.task('queryDb', "SELECT * FROM `sprint`;")
                    .then(results => {
                        expect(results).not.to.be.empty;
                        expect(results).to.have.lengthOf(1);
                    });
                cy.get('.sprint').should('have.length', 2)
            });
        cy.get('.delete-sprint').click()
            .then(() => {
                cy.get('.modal').should('be.visible')
                    .then(() => {
                        cy.get('.delete-button').click()
                            .then(() => {
                                cy.reload();
                                cy.get('.sprint').should('have.length', 1)
                                cy.task('queryDb', "SELECT * FROM `sprint`;")
                                    .then(results => {
                                        expect(results).to.be.empty;
                                    });
                            });
                    });
            });


    })

    it('delete an issue in the backlog', () => {
        cy.task('queryDb', "INSERT INTO `issue` (project_id, order_in_sprint, title, description)" +
            "VALUES(1, 1, 'issue test', 'description test');")
            .then(() => {
                cy.reload();
                cy.task('queryDb', "SELECT * FROM `issue`;")
                    .then(results => {
                        expect(results).not.to.be.empty;
                        expect(results).to.have.lengthOf(1);
                    });
                cy.get('#backlog ul').find('li').should('have.length', 1)
            })
        cy.get('#backlog ul').find('li').first().find('.delete-issue').click();
        cy.get('.delete-button').should('be.visible', { timeout: 20000 }).click();
        cy.reload();
        cy.task('queryDb', "SELECT * FROM `issue`;")
            .then(results => {
                expect(results).to.be.empty;
                cy.get('#backlog ul').find('li').should('have.length', 0);
            })
    })

    it('delete an issue in a sprint', () => {
        cy.task('queryDb', "INSERT INTO `sprint` (project_id, title) VALUES('1','Sprint to delete');")
        cy.task('queryDb', "INSERT INTO `issue` (project_id, sprint_id, order_in_sprint, title, description)" +
            "VALUES(1, 1, 1, 'issue test', 'description test');")
            .then(() => {
                cy.reload();
                cy.task('queryDb', "SELECT * FROM `issue`;")
                    .then(results => {
                        expect(results).not.to.be.empty;
                        expect(results).to.have.lengthOf(1);
                    });
                cy.get('.sprint').first().find('li').should('have.length', 1)
            })
        cy.get('.sprint ul').first().find('li').first().find('.delete-issue').click();
        cy.get('.delete-button').should('be.visible', { timeout: 20000 }).click();
        cy.reload();
        cy.task('queryDb', "SELECT * FROM `issue`;")
            .then(results => {
                expect(results).to.be.empty;
                cy.get('.sprint').first().find('li').should('have.length', 0);
            })
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

