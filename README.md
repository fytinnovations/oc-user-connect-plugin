# User Connect - OctoberCMS Email Subscription Management

Creating and manage email subscription lists with ease.

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

## Usage

### SubscriptionForm component

You can embed the subscription form on any page which allows user to subscribe to your website.

Sample Markup

```ini
title = "Demonstration"
url = "/"
layout = "default"
is_hidden = 0

[subscriptionForm]
subscribeButtonText = "Subscribe now"
successMessage = "Thankyou for subscribing we'll contact you soon"
category = 2
==
<div class="jumbotron">
    <div class="container">
        {% content "welcome.htm" %}
    </div>
</div>

```

#### Component Properties

| Value               | Description                                                                              | Default                                           | Required |
|---------------------|------------------------------------------------------------------------------------------|---------------------------------------------------|----------|
| subscribeButtonText | The text which should be displayed on the subscribe button.                              | Subscribe Now                                     | No       |
| successMessage      | The message to be displayed when the user successfully submits the  subscription request | Thankyou for subscribing we'll  contact you soon. | No       |
| category            | The category the subscription will be submitted to.                                      | Uncategorized (1)                                 | Yes      |

### Configuration Options

#### Verify Via Email

Enable this option if you would like to verify subscriptions using emails.

#### Key Expires in (Days)

Enter the number of days after which the key will be expired. Available only when Verify via Email is enabled.

#### Verification Success Page

The page to redirect the user when the subscription is successful. Once the subscription is verified there is a message embedded automatically in the session you can use the flash twig component on the page to output the message.

Example

```ini
title = "Account"
url = "/account/:code?"
layout = default

[account]
redirect = "home"
paramCode = "code"
==

<div class="container m-a">
    {% flash success %}
    <div class="alert alert-success">{{ message }}</div>
    {% endflash %}
    {% component 'account' %}
</div>

```

## Running the tests

1. Go the plugin's base directory(i.e plugins/fytinnovations/userconnect) and run `../../../vendor/bin/phpunit` to run a series of test cases.

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://github.com/fytinnovations/oc-user-connect/tags). 

## Authors

**[4nik3t](https://github.com/4nik3t)**

See also the list of [contributors](https://github.com/fytinnovations/oc-user-connect/contributors) who participated in this project.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Icon Credit

Icons made by [Eucalyp](https://www.flaticon.com/authors/eucalyp) from [Flaticon](www.flaticon.com) is licensed by [CC 3.0](http://creativecommons.org/licenses/by/3.0/)

## Donations

You can support our open source organisation through donations using our [patreon](https://patreon.com/fytinnovations)
