API_URL='https://api.soundcloud.com/playlists/10225031?show_tracks=true'
ACCESS_TOKEN='2-300783--U0eyYFDLYbuFV3JH4WBG93o'


curl -X 'GET' "$API_URL" \
  -H 'accept: application/json; charset=utf-8' \
  -H "Authorization: Bearer $ACCESS_TOKEN" \