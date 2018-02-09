/**
 * A sample test.js file. Allowed extension: .js | .ts
 * For more information, visit here: https://github.com/DevExpress/testcafe
 *
 */
import { Selector } from 'testcafe'; // first import testcafe selectors

// declare the fixture
fixture `Getting Started`
    .page `https://master-7rqtwti-4fy3zdkvhdlbw.us.platform.sh`;  // specify the start page


//then create a test and place your code there
test('Page title should contain what the user searched for', async t => {
    await t
        .typeText('#edit-keys', 'Alice Kim')
        .click('#edit-submit')
        .expect(Selector('.page-title').innerText).eql('Search for Alice Kim'); //catches an error when expect fails
});

//page refreshes and goes back to the starting point specified above using the fixture
test('Should be able to allow the user to search again', async t => {
    await t
        .typeText('#edit-keys', 'alice kim')
        .click('#edit-submit')
        .expect(Selector('.page-title').innerText).eql('Search for alice kim');
});
