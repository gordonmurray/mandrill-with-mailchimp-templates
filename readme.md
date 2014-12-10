Using Mandrill with MailChimp Templates
=======================================

This is a basic working example of how to begin sending emails using Mandrill, to send normal emails or using a Template created in MailChimp.

First steps (for the account owner to perform first)
--------------------------------------------

1. A MailChimp account needs to be set up by the owner at http://mailchimp.com/.
2. A Mandrill account also needs to be set up by the owner at https://www.mandrill.com/.
3. Once both accounts are created, the owner needs to connect the accounts together manually in a once-off step. This is performed in the 'Integrations' section of Mailchimp and there is a guide on how to do it here: (http://help.mandrill.com/entries/21681117-How-do-I-use-Mandrill-if-I-already-have-a-MailChimp-account-)
4. Then, the owner needs to create or edit a template in MailChimp and when ready, send it to Mandrill. There is a guide on how to do this here: (http://help.mandrill.com/entries/24460672-How-do-I-add-a-MailChimp-template-to-my-Mandrill-account-)
5. Important: Any time the owner changes the template, it needs to be re-sent to Mandrill to take effect using step 4 above.
6. The owner will need to make sure there are suitable variables in the Template. For example *|HEADING|* or *|FNAME|*, so the software code can replace that with a correct heading or name name later on when sending.
7. Important: A developer will need your Mandrill API key in order to send out emails from your account, this is found in Mandrill in 'Settings' and press on 'Add new Key'.
7. Important: A developer will need to know the exact name of the template you have created.

Steps for sending normal and template emails (for a developer)
----------------------------------------------------------------

* Note: There are samples to send a normal email and also a template email in the index.php file
* Note: This example needs an API key to be added and also a recipient email address
* Note: Silex is used in this example code to call the Mandrill Library and isn't critical to use Mandrill.
* Note: To send using Mandrill, we use a PHP Library, installed using Composer (See: https://mandrillapp.com/api/docs/index.php.html)

1. To get this running locally, clone this repo and run : php composer.phar install to install Silex, Mandrill and other dependencies then open the following the browser: http://localhost/mandrill_with_mailchimp_template/index.php
2. [update API_KEY in examples] To initialise the library, we need the owners API key (from step 6 above) and then use the following to initialize: $mandrill = new Mandrill('API-KEY-HERE');
3. [update $recipient_email_address AND $recipient_name examples] Then send emails using : $mandrill->messages->send();
4. [update template name in examples] Code examples for sending a normal email (without a template) and also a template-based email are in index.php
5. [in place in the examples] When sending an email, the variables such as *|HEADING|* can be changed in the template.
6. [in place in the examples] When sending an email, the variables such as *|FNAME|* can be changed per person based on email address.

Editing templates
---------

1. Templates can be edited directly from mailchimp.com interfance.
2. Dynamic elements are marked with the format mc:edit="name_of_marker". E.g. <div class="calendar-month" mc:edit="event_date_month">
3. Mailchimp is very exigent with the structure of the markers and will automatically delete anything with invalid format. Pay special care to nested elements, totally forbidden. e.g. 
       <table mc:edit="table_element">
       <tr>
       <td mc:edit="column_element">
       </tr>
       </table>
In this example, Mailchimp will automatically delete the column_element after saving the template.
4. After saving the template we still need to click on 'Send to Mandrill', otherwise last changes are not usable yet.

Problems?
---------

* If you get the following error : ***"SSL certificate problem: unable to get local issuer certificate"*** then add the following to around Line 105 of /vendor/mandrill/src/Mandrill.php:
* curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );

* If you get a message 'unknown_template' probably the reason is because the template exists in Mailchimp but it wasn't sent to Mandrill yet. You can fix it going to the template list, selecting it and clicking on 'Send to Mandrill'. It takes a few seconds until you get a confirmation message.


