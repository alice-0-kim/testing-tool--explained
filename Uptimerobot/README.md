# Uptimerobot

## Configuration
### Adding a New Monitor
1. Log into [Uptime Robot](https://uptimerobot.com/). You will be redirected to `My dashboard` page.
2. Click `Add New Monitor` button located at the top left corner.

[!](screenshot.png)

3. Enter Monitor information:
  - Monitor Type: HTTP(s)
  - Friendly Name: domain, __without__ the https://
    - e.g. example.it.ubc.ca
  - URL (or IP): domain, including the https://
    - e.g. https://example.it.ubc.ca
  - Monitoring Interval: every 1 minutes
 
 [!](screenshot.png)

  - Leave out Advanced Settings, if not specifically requested.
  - Select Alert Contacts To Notify:
    - For 24/7
      - Web Services
      - Emergency Phone
      - Slack notification
    - For Business Hours
      - Web Services
      - Slack notification
  - Click wheel icon to set the duration of notification. Default value as of now: __3__ minutes, notify __once__.
  - Tip: If you do not see the icon, click show advanced options at the top right corner.

### Adding a New Alert Contact
1. Go to My Settings page.

[!](screenshot.png)

2. Click Add Alert Contact at the top right corner.
3. Select appropriate Alert Contact Type.

## Bulk Actions
This feature is very useful when updating intervals or alert contacts of monitors.

1. Click Bulk Actions at the top left corner under Add New Monitor button.

[!](screenshot.png)

2. Fill out Action Details based on your needs e.g. I want to change the intervals of monitors for all monitors.
  - Tip: If it is asking for you to write CHANGE INTERVAL as an Approval Text e.g. Please write CHANGE INTERVAL to the field below to approve the action, all you need to do is to enter CHANGE INTERVAL literally and press the Complete Action button to save.
