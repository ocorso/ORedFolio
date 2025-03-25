CLIENT_ID='f06U4kV8Y2ipTGwe73YmApr9OXfwRWLp'
CLIENT_SECRET='eU2HoViIFLO0PDIizRWUAEwus70Vz9wq'
REFRESH_TOKEN='Fw4u2Ad9z1G1i8ZEob9lE46gFVte4Gfp'
OAUTH_ENDPOINT='https://secure.soundcloud.com/oauth/token'

# refresh token
curl -X POST "$OAUTH_ENDPOINT" \
     -H  "accept: application/json; charset=utf-8" \
     -H  "Content-Type: application/x-www-form-urlencoded" \
     --data-urlencode "grant_type=refresh_token" \
     --data-urlencode "client_id=$CLIENT_ID" \
     --data-urlencode "client_secret=$CLIENT_SECRET" \
     --data-urlencode "refresh_token=$REFRESH_TOKEN" \