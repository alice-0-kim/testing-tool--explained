/**
 * A sample test.js file. Allowed extension: .js | .ts
 * For more information, visit here: https://github.com/DevExpress/testcafe
 */
import { Selector } from 'testcafe'; // first import testcafe selectors

// declare the fixture
fixture `Getting Started`
    .page `https://master-7rqtwti-4fy3zdkvhdlbw.us.platform.sh`;  // specify the start page


//then create a test and place your code there
test('My first test', async t => {
    await t
        .typeText('#edit-keys', 'Alice Kim')
        .click('#edit-submit');
});
