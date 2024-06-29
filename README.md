# Delivery Management

![Login Page](https://user-images.githubusercontent.com/48416569/180636827-9985a1c6-7048-4851-aa4e-3a5710743be4.png "Login Page")

![Purchase Page](https://user-images.githubusercontent.com/48416569/131342128-79e5b127-e533-4efc-9170-adaff9d1c318.png "Purchase Page")

- - -

## 🚀 Getting Started

First, after you've cloned this project, you will need to install the dependencies:

```SHELL
composer install
```

In addition, migrate your database:

```SHELL
php artisan migrate
```

Moreover, link the storage for uploading avatars:

```SHELL
php artisan storage:link
```

> [!IMPORTANT]
> If you want to send notifications, do not forget to get `PUSHER_APP_ID`, `PUSHER_APP_KEY`, and `PUSHER_APP_SECRET` via creating a new project in [PUSHER](https://pusher.com/), and to login via **Facebook** you should get `FACEBOOK_CLIENT_ID`, and `FACEBOOK_CLIENT_SECRET` from [Facebook Developer](https://developers.facebook.com/)
