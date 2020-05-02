# User Connect - OctoberCMS Email Subscription Management

## About

User-connect helps you manage your email subscription list. You can now easily add a subscribe segment to your octoberCMS website.

## Features

1. Cater Verified Users Only

    - Enabling "verify via email" toggle in the settings page allows you to filter spam users and only serve the verified ones.

2. Efficiently Manage Outgoing Traffic
    - Websites containing more than one subscription segments can create categories for each segment using the plugin. Visitors to the website can only subscribe to segments which they are interested in.

3. Useful Graphs and Charts
    - The subscription dashboard of the user connect plugin provides a birds-eye view of your current subscription base. The subscription graphs provides a visualization of the number of users subscribing each day. This graph can be helpful to monitor your current performance and also predict your future trends.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

What things you need to install the software and how to install them

- A Local October CMS Setup
- Git, of course

### Installing

#### Via Github

1. Create a folder inside the plugins directory called `fytinnovations/userconnect` .
2. Clone or copy the contents of the repository to this folder.
3. Logout and login to the backend to see the plugin in effect or alternatively you can run the command `php artisan october:up`.

#### Via marketplace

1. [Visit](https://octobercms.com/plugins/fytinnovations-userconnect) the plugin page in OctoberCMS marketplace and click on Add to Project.

### Configuration Options

#### Verify Via Email

Enable this option if you would like to verify subscriptions using emails.

#### Key Expires in (Days)

Enter the number of days after which the key will be expired. Available only when Verify via Email is enabled.

## Running the tests

1. Go the plugin's base directory(i.e plugins/fytinnovations/userconnect) and run `../../../vendor/bin/phpunit` to run a series of test cases.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fytinnovations/oc-user-connect/tags). 

See also the list of [contributors](https://github.com/fytinnovations/oc-user-connect/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Icon Credit

Icons made by [Eucalyp](https://www.flaticon.com/authors/eucalyp) from [Flaticon](www.flaticon.com) is licensed by [CC 3.0](http://creativecommons.org/licenses/by/3.0/)

## Donations

You can support our open source organisation through donations using our [patreon](https://patreon.com/fytinnovations)
