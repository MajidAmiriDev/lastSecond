1.	docker-compose up -d --build
2.	docker exec laravel-app composer install


POSTMAN Collection:



{
  "info": {
    "_postman_id": "UUID",
    "name": "Laravel API",
    "description": "Postman collection for testing Laravel API endpoints",
    "schema": "https://schema.getpostman.com/json/collection/v2.1.0/collection.json"
  },
  "item": [
    {
      "name": "Authenticate User",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"email\": \"your-email@example.com\",\n    \"password\": \"your-password\"\n}"
        },
        "url": {
          "raw": "http://your-domain/api/login",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "login"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Create Activity",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          },
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"name\": \"Activity Name\",\n    \"description\": \"Activity Description\",\n    \"location\": \"Activity Location\",\n    \"price\": 50.00,\n    \"available_slots\": 10\n}"
        },
        "url": {
          "raw": "http://your-domain/api/activities",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "activities"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Get All Activities",
      "request": {
        "method": "GET",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "url": {
          "raw": "http://your-domain/api/activities",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "activities"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Update Activity",
      "request": {
        "method": "PUT",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          },
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"name\": \"Updated Activity Name\",\n    \"description\": \"Updated Activity Description\",\n    \"location\": \"Updated Activity Location\",\n    \"price\": 60.00,\n    \"available_slots\": 15\n}"
        },
        "url": {
          "raw": "http://your-domain/api/activities/{{activity_id}}",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "activities",
            "{{activity_id}}"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Delete Activity",
      "request": {
        "method": "DELETE",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "url": {
          "raw": "http://your-domain/api/activities/{{activity_id}}",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "activities",
            "{{activity_id}}"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Create Booking",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Content-Type",
            "value": "application/json"
          },
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "body": {
          "mode": "raw",
          "raw": "{\n    \"activity_id\": 1,\n    \"user_name\": \"John Doe\",\n    \"user_email\": \"john.doe@example.com\",\n    \"slots_booked\": 3\n}"
        },
        "url": {
          "raw": "http://your-domain/api/bookings",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "bookings"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Cancel Booking",
      "request": {
        "method": "POST",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "url": {
          "raw": "http://your-domain/api/bookings/{{booking_id}}/cancel",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "bookings",
            "{{booking_id}}",
            "cancel"
          ]
        }
      },
      "response": []
    },
    {
      "name": "Search Activities",
      "request": {
        "method": "GET",
        "header": [
          {
            "key": "Authorization",
            "value": "Bearer {{access_token}}"
          }
        ],
        "url": {
          "raw": "http://your-domain/api/activities/search?name=Activity%20Name&location=Activity%20Location&price_min=50&price_max=100",
          "protocol": "http",
          "host": [
            "your-domain"
          ],
          "path": [
            "api",
            "activities",
            "search"
          ],
          "query": [
            {
              "key": "name",
              "value": "Activity Name"
            },
            {
              "key": "location",
              "value": "Activity Location"
            },
            {
              "key": "price_min",
              "value": "50"
            },
            {
              "key": "price_max",
              "value": "100"
            }
          ]
        }
      },
      "response": []
    }
  ]
}