CLIENT_ID="f06U4kV8Y2ipTGwe73YmApr9OXfwRWLp"
CLIENT_SECRET="eU2HoViIFLO0PDIizRWUAEwus70Vz9wq"
ENCODED_AUTH=$(printf "$CLIENT_ID:$CLIENT_SECRET" | base64)
OAUTH_ENDPOINT="https://secure.soundcloud.com/oauth/token"

curl -X POST "$OAUTH_ENDPOINT" \
     -H  "accept: application/json; charset=utf-8" \
     -H  "Content-Type: application/x-www-form-urlencoded" \
     -H  "Authorization: Basic $ENCODED_AUTH" \
     --data-urlencode "grant_type=client_credentials"