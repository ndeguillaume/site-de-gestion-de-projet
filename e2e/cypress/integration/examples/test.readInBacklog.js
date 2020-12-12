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

    it('read info of an issue in the backlog', () => {
        cy.task('queryDb', "INSERT INTO `issue` (project_id, order_in_sprint, title, description, priority, cost)" +
                            "VALUES(1, 1, 'issue test', 'description test', 'medium', 1);")
            .then(() => {
                cy.reload();
                cy.task('queryDb', "SELECT * FROM `issue`;")
                    .then(results => {
                        expect(results).not.to.be.empty;
                        expect(results).to.have.lengthOf(1);
                    });
                cy.get('#backlog ul').find('li').should('have.length', 1).click();
                cy.get('body').find('.issue-information').should('be.visible');
                cy.get('.issue-information').find('.issue-id').contains('1');
                cy.get('.issue-information .issue-information-title').should('have.value', 'issue test');
                cy.get('.issue-information .issue-information-description').should('have.value', 'description test');
                cy.get('.issue-information .issue-information-priority').should('have.value', 'medium');
                cy.get('.issue-information .issue-information-cost').should('have.value', 1);
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

