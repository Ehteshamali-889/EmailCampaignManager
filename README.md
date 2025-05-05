# Email Campaign Manager

This package allows you to create, filter, and send email campaigns to customers. It is designed as a reusable Laravel package that works with services like SendGrid.

## Installation

```bash
composer require yourname/email-campaign-manager
```

## Configuration

- Set your SendGrid API key in `.env`:
  ```
  SENDGRID_API_KEY=your_sendgrid_api_key
  ```

## Usage

- Create a campaign:
  ```
  POST /campaigns
  ```

- Filter audience:
  ```
  POST /campaigns/filter
  ```

- Send a campaign:
  ```
  POST /campaigns/send
  ```
