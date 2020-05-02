For complete documentation of the plugin visit https://oc-user-connect.fytinnovations.com/

# Components

## SubscriptionForm component

You can embed the subscription form on any page which allows user to subscribe to your website.

Sample Markup

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

### Component Properties

| Value               | Description                                                                              | Default                                           | Required |
|---------------------|------------------------------------------------------------------------------------------|---------------------------------------------------|----------|
| subscribeButtonText | The text which should be displayed on the subscribe button.                              | Subscribe Now                                     | No       |
| successMessage      | The message to be displayed when the user successfully submits the  subscription request | Thankyou for subscribing we'll  contact you soon. | No       |
| category            | The category the subscription will be submitted to.                                      | Uncategorized (1)                                 | Yes      |


## Verification Success Page

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
