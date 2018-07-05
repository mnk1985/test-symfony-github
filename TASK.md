## Thank you for accepting the challenge! Please find below the description of the task:
 * Please implement a  PHP Symfony 2/3-Application, which generates a github resumé for a given github account similar to http://resume.github.io/ 
* Create a landing page at which the user enters the account name (e.g. “mxcl”)
* Implement a “generate button” on the landing page that redirects to a generated resumé page
* The resume page shows the following things:
  * Username and a link to the users website (if any is provided)
  * Amount and list of repositories (name, link and description)
  * Percentages of programming languages for the account (Aggregated by primary language of the repository in ratio to the size of the repository) 
  * This is sufficient. Feel free to add more statistics or to aggregate more data if you wish to.
* Make sure to use the github API, please don't start parsing web pages manually.
 
## Mini-FAQ:
* Github-Rate-Limit: Your app should not hit any public rate limit. If your app hits rate limits, use your github username+password or oauth token to get up to 5000 req/hour.
* How to launch? Your app should start with “php bin/console server:start”
* HTML+Design: Design Skills are not subject of the task, so the data is important.