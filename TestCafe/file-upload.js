
/**
 * A sample test.js file. Allowed extension: .js | .ts
 * For more information, visit here: https://github.com/DevExpress/testcafe
 *
 */
import { Selector } from 'testcafe'; // first import testcafe selectors

// declare the fixture
fixture `Getting Started`
    .page `http://drupal-8-5-0.dd:8083/user`;  // specify the start page

var user_name = 'alice828';
var user_pass = '*~Ak5058Sl~*';

//then create a test and place your code there
test('Test #001', async t => {
    await t
        .typeText('#edit-name', user_name)
        .typeText('#edit-pass', user_pass)
        .click("input[value='Log in']")
        .expect(Selector('.page-title').innerText).eql(user_name); //catches an error when expect fails
});

// fixture `Getting Started`
//     .page `http://drupal-8-5-0.dd:8083/node/add/ubc_landing_page`;
// test('Test #002', async t => {
//     await t
//         .click('#edit-field-landing-feature-image-0-upload')
//         .expect(Selector('.page-title').innerText).eql('Create Landing Page'); //catches an error when expect fails    
// });