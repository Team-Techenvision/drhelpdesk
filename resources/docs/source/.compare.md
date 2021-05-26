---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://drhelpdesk.in/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_d7b7952e7fdddc07c978c9bdaf757acf -->
## api/register
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/register`


<!-- END_d7b7952e7fdddc07c978c9bdaf757acf -->

<!-- START_c3fa189a6c95ca36ad6ac4791a873d23 -->
## api/login
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/login`


<!-- END_c3fa189a6c95ca36ad6ac4791a873d23 -->

<!-- START_0be998bf1baa627e4330d0c08528a72d -->
## api/social-login
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/social-login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/social-login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/social-login`


<!-- END_0be998bf1baa627e4330d0c08528a72d -->

<!-- START_bfe175ca429dc76b7dfdecd4efbce576 -->
## api/write-review
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/write-review" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/write-review"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/write-review`


<!-- END_bfe175ca429dc76b7dfdecd4efbce576 -->

<!-- START_65cf8ff3b6ba2c8cd2633a80721461aa -->
## api/show-review
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/show-review" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/show-review"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/show-review`


<!-- END_65cf8ff3b6ba2c8cd2633a80721461aa -->

<!-- START_76fc638d2076ee5f40a73148e4708c6a -->
## api/apply-coupen
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/apply-coupen" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/apply-coupen"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/apply-coupen`


<!-- END_76fc638d2076ee5f40a73148e4708c6a -->

<!-- START_3f9bdba87e18d94e4b2e54d1bbc0e84a -->
## api/edit-user-profile
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/edit-user-profile" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/edit-user-profile"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/edit-user-profile`


<!-- END_3f9bdba87e18d94e4b2e54d1bbc0e84a -->

<!-- START_4718503641f9ab71a92dd1627b31628d -->
## api/change-password
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/change-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/change-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/change-password`


<!-- END_4718503641f9ab71a92dd1627b31628d -->

<!-- START_78c4b7d6388c81c68bc37ec872d44f65 -->
## api/forgot-password
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/forgot-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/forgot-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/forgot-password`


<!-- END_78c4b7d6388c81c68bc37ec872d44f65 -->

<!-- START_432698373038a1efef9865371c9a6f08 -->
## api/otp
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/otp`


<!-- END_432698373038a1efef9865371c9a6f08 -->

<!-- START_c4ae5f0a1fdb300daa84a04a4bf045d3 -->
## api/forgot_password_otp
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/forgot_password_otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/forgot_password_otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/forgot_password_otp`


<!-- END_c4ae5f0a1fdb300daa84a04a4bf045d3 -->

<!-- START_4ff0314c7bdeaf1e359f332cfb517313 -->
## api/verify_forgot_password_otp
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/verify_forgot_password_otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/verify_forgot_password_otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/verify_forgot_password_otp`


<!-- END_4ff0314c7bdeaf1e359f332cfb517313 -->

<!-- START_b171a84e0b75347f92911f68c515d252 -->
## api/forgot_password_set
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/forgot_password_set" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/forgot_password_set"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/forgot_password_set`


<!-- END_b171a84e0b75347f92911f68c515d252 -->

<!-- START_4e5532cd3e5f2b78bbe4d7b3bae6d931 -->
## api/refer-code
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/refer-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/refer-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/refer-code`


<!-- END_4e5532cd3e5f2b78bbe4d7b3bae6d931 -->

<!-- START_b41dcb8bf521b19a8503dfa3ef1f9182 -->
## api/doctor-list
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/doctor-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/doctor-list`


<!-- END_b41dcb8bf521b19a8503dfa3ef1f9182 -->

<!-- START_74c493cc36da62025e3c24ccb512f3a8 -->
## api/user-uses-doctor
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/user-uses-doctor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-uses-doctor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/user-uses-doctor`


<!-- END_74c493cc36da62025e3c24ccb512f3a8 -->

<!-- START_b396eaf9e340f290daaa1e37aba3dba9 -->
## api/user-wallet-history
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/user-wallet-history" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-wallet-history"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/user-wallet-history`


<!-- END_b396eaf9e340f290daaa1e37aba3dba9 -->

<!-- START_4e12a53588caca47c744f9e61e9b78de -->
## api/user-add-wallet
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/user-add-wallet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-add-wallet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user-add-wallet`


<!-- END_4e12a53588caca47c744f9e61e9b78de -->

<!-- START_a3bcf3c4fd455e537532ce48fb9067d6 -->
## api/user-consult-doctor
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/user-consult-doctor" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-consult-doctor"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user-consult-doctor`


<!-- END_a3bcf3c4fd455e537532ce48fb9067d6 -->

<!-- START_249d9f90f390f86427891989903ed269 -->
## api/add-credit
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/add-credit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/add-credit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/add-credit`


<!-- END_249d9f90f390f86427891989903ed269 -->

<!-- START_a5a91934dec01d955f2b6663d12bd8cd -->
## api/doctor-call
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/doctor-call" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-call"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/doctor-call`


<!-- END_a5a91934dec01d955f2b6663d12bd8cd -->

<!-- START_8955fd8074eb6a3071105b41c8555c0b -->
## api/device-registered
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/device-registered" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/device-registered"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/device-registered`


<!-- END_8955fd8074eb6a3071105b41c8555c0b -->

<!-- START_515f3baa210e04d8a4042baa49668732 -->
## api/write-doctor-review
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/write-doctor-review" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/write-doctor-review"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/write-doctor-review`


<!-- END_515f3baa210e04d8a4042baa49668732 -->

<!-- START_bc85008f122012c4f8466a939387317f -->
## api/write-doctor-recommandation
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/write-doctor-recommandation" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/write-doctor-recommandation"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/write-doctor-recommandation`


<!-- END_bc85008f122012c4f8466a939387317f -->

<!-- START_e8d28c3b9303fae8f3c486cc4bbce545 -->
## api/happy-code
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/happy-code" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/happy-code"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/happy-code`


<!-- END_e8d28c3b9303fae8f3c486cc4bbce545 -->

<!-- START_6ef7b3fa797f9e9cb07f8e6c85279f0c -->
## api/order-payment-failed
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/order-payment-failed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/order-payment-failed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/order-payment-failed`


<!-- END_6ef7b3fa797f9e9cb07f8e6c85279f0c -->

<!-- START_109013899e0bc43247b0f00b67f889cf -->
## api/categories
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/categories`


<!-- END_109013899e0bc43247b0f00b67f889cf -->

<!-- START_4caf80d3f8822cd78ae56c7435f55ce9 -->
## api/sub-categories
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/sub-categories" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/sub-categories"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/sub-categories`


<!-- END_4caf80d3f8822cd78ae56c7435f55ce9 -->

<!-- START_dc538d69a8586a7a3c36d4393cee42e6 -->
## api/product
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product`


<!-- END_dc538d69a8586a7a3c36d4393cee42e6 -->

<!-- START_5b43794b48d4385c39814b850523e694 -->
## api/product-count
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-count`


<!-- END_5b43794b48d4385c39814b850523e694 -->

<!-- START_0d34eada33e257047d669274b510ec0e -->
## api/product-detail
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-detail`


<!-- END_0d34eada33e257047d669274b510ec0e -->

<!-- START_3cd71c8e40c3edc869245223a5414b0c -->
## api/doctor-listing
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/doctor-listing" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-listing"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/doctor-listing`


<!-- END_3cd71c8e40c3edc869245223a5414b0c -->

<!-- START_7e20b82206286c4086c3991585a8f085 -->
## api/location-list
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/location-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/location-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/location-list`


<!-- END_7e20b82206286c4086c3991585a8f085 -->

<!-- START_77f13b561192f838958b4e63edd6a268 -->
## api/home-page
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/home-page" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/home-page"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/home-page`


<!-- END_77f13b561192f838958b4e63edd6a268 -->

<!-- START_599c26ad20d14852d71965c47ac24a59 -->
## api/add-to-cart
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/add-to-cart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/add-to-cart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/add-to-cart`


<!-- END_599c26ad20d14852d71965c47ac24a59 -->

<!-- START_ecf302e274545e07f802764856972553 -->
## api/set_default_address
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/set_default_address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/set_default_address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/set_default_address`


<!-- END_ecf302e274545e07f802764856972553 -->

<!-- START_20dbeffe684d66df35d4324f109954ba -->
## api/my-cart
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/my-cart" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/my-cart"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/my-cart`


<!-- END_20dbeffe684d66df35d4324f109954ba -->

<!-- START_3910324459f124f3ea9c178d9c278861 -->
## api/brand
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/brand" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/brand"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/brand`


<!-- END_3910324459f124f3ea9c178d9c278861 -->

<!-- START_0ab7e77fb1551efbc99a37b4d3186886 -->
## api/doctor-detail
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/doctor-detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/doctor-detail`


<!-- END_0ab7e77fb1551efbc99a37b4d3186886 -->

<!-- START_d1a8c1661bb4949be36fc24f334d3b04 -->
## api/lab-test
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/lab-test" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/lab-test"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/lab-test`


<!-- END_d1a8c1661bb4949be36fc24f334d3b04 -->

<!-- START_511b6c7f40e0348a3c9679d054731a74 -->
## api/lab-test-count
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/lab-test-count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/lab-test-count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/lab-test-count`


<!-- END_511b6c7f40e0348a3c9679d054731a74 -->

<!-- START_29f29f57f0a262f3003be3c81f96de3c -->
## api/vendor-order
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/vendor-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/vendor-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/vendor-order`


<!-- END_29f29f57f0a262f3003be3c81f96de3c -->

<!-- START_63b61127af2ea82a34678dde253e7a67 -->
## api/shipping-charge
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/shipping-charge" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/shipping-charge"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/shipping-charge`


<!-- END_63b61127af2ea82a34678dde253e7a67 -->

<!-- START_11940d3c98d3619983febd8868824563 -->
## api/shipping-setting
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/shipping-setting" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/shipping-setting"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/shipping-setting`


<!-- END_11940d3c98d3619983febd8868824563 -->

<!-- START_44732c49e0d21387124b57a09a8099cc -->
## api/user-wallet
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/user-wallet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-wallet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/user-wallet`


<!-- END_44732c49e0d21387124b57a09a8099cc -->

<!-- START_4ec9a363c62debcae1e6014492597c5a -->
## api/delivery-boy
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/delivery-boy" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/delivery-boy"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/delivery-boy`


<!-- END_4ec9a363c62debcae1e6014492597c5a -->

<!-- START_801156377d29bc3b2afbda98d1ab85dd -->
## api/add-to-wishlist
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/add-to-wishlist" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/add-to-wishlist"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/add-to-wishlist`


<!-- END_801156377d29bc3b2afbda98d1ab85dd -->

<!-- START_4330efab5ed23b3235e57012ae7c88dd -->
## api/my-wishlist
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/my-wishlist" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/my-wishlist"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/my-wishlist`


<!-- END_4330efab5ed23b3235e57012ae7c88dd -->

<!-- START_220d40b11694b17ddffb55efc8266bee -->
## api/product-filter
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-filter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-filter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-filter`


<!-- END_220d40b11694b17ddffb55efc8266bee -->

<!-- START_0852249d3fb4f18c4772b2313771f639 -->
## api/product-filter-sort
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-filter-sort" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-filter-sort"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-filter-sort`


<!-- END_0852249d3fb4f18c4772b2313771f639 -->

<!-- START_49bb75770a83645ff2669ba42301aa31 -->
## api/all-city
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/all-city" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/all-city"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/all-city`


<!-- END_49bb75770a83645ff2669ba42301aa31 -->

<!-- START_18f67313b55834c95378056fc9131a22 -->
## api/search-data
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/search-data" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/search-data"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/search-data`


<!-- END_18f67313b55834c95378056fc9131a22 -->

<!-- START_f7828fe70326ce6166fdba9c0c9d80ed -->
## api/search
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/search`


<!-- END_f7828fe70326ce6166fdba9c0c9d80ed -->

<!-- START_0137132c4b8b7480209503c2e8b84dbd -->
## api/product-by-brand
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-by-brand" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-by-brand"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-by-brand`


<!-- END_0137132c4b8b7480209503c2e8b84dbd -->

<!-- START_9efbb63c24e876c9f2196cb4815fb89e -->
## api/product-by-brand-count
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/product-by-brand-count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/product-by-brand-count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/product-by-brand-count`


<!-- END_9efbb63c24e876c9f2196cb4815fb89e -->

<!-- START_8bf6b43180c8e954c7b115d139ae1323 -->
## api/add-address
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/add-address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/add-address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/add-address`


<!-- END_8bf6b43180c8e954c7b115d139ae1323 -->

<!-- START_ac05be89253125d3a314619c2c129307 -->
## api/user-address
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/user-address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user-address`


<!-- END_ac05be89253125d3a314619c2c129307 -->

<!-- START_37ea376344bc068a0cac36f7d30b4513 -->
## api/place-order
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/place-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/place-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/place-order`


<!-- END_37ea376344bc068a0cac36f7d30b4513 -->

<!-- START_dffac5d06a3a136827969da93905930a -->
## api/place-cart-order
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/place-cart-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/place-cart-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/place-cart-order`


<!-- END_dffac5d06a3a136827969da93905930a -->

<!-- START_5807b3245649c6edcb98569dd75c27f9 -->
## api/cart-update
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/cart-update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/cart-update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/cart-update`


<!-- END_5807b3245649c6edcb98569dd75c27f9 -->

<!-- START_4bf19541f02a57fc0a555fee064b64bc -->
## api/remove-product
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/remove-product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/remove-product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/remove-product`


<!-- END_4bf19541f02a57fc0a555fee064b64bc -->

<!-- START_86632a2d03c559b0adfccb4888094307 -->
## api/my-order
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/my-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/my-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/my-order`


<!-- END_86632a2d03c559b0adfccb4888094307 -->

<!-- START_911a6b87a9777b7f5bfcb5df1653c130 -->
## api/my-booking
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/my-booking" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/my-booking"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/my-booking`


<!-- END_911a6b87a9777b7f5bfcb5df1653c130 -->

<!-- START_7a2848f1f8ca53cc953847234a8f94e0 -->
## api/order-details
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/order-details" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/order-details"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/order-details`


<!-- END_7a2848f1f8ca53cc953847234a8f94e0 -->

<!-- START_ed8c996b991c0384ad817d6acc0a146b -->
## api/sub-order-listing
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/sub-order-listing" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/sub-order-listing"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/sub-order-listing`


<!-- END_ed8c996b991c0384ad817d6acc0a146b -->

<!-- START_d84daa6da03c8f4cbc5f04a27f8738e4 -->
## api/sub-booking-listing
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/sub-booking-listing" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/sub-booking-listing"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/sub-booking-listing`


<!-- END_d84daa6da03c8f4cbc5f04a27f8738e4 -->

<!-- START_1e8da93ab641cc888d5f94c17de63e29 -->
## api/cancle-order
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/cancle-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/cancle-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/cancle-order`


<!-- END_1e8da93ab641cc888d5f94c17de63e29 -->

<!-- START_a1c699ffa71362b4d8dee93d986a505e -->
## api/doctor-appointment
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/doctor-appointment" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-appointment"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/doctor-appointment`


<!-- END_a1c699ffa71362b4d8dee93d986a505e -->

<!-- START_544a810e1511df90f299587dcfc2ed83 -->
## api/upload-prescription
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/upload-prescription" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/upload-prescription"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/upload-prescription`


<!-- END_544a810e1511df90f299587dcfc2ed83 -->

<!-- START_6697f5046d6971dc2efc815cd4e6c659 -->
## api/delete-prescription
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/delete-prescription" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/delete-prescription"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/delete-prescription`


<!-- END_6697f5046d6971dc2efc815cd4e6c659 -->

<!-- START_95d39a92f96d43389656b73572e61e12 -->
## api/prescription-list
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/prescription-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/prescription-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/prescription-list`


<!-- END_95d39a92f96d43389656b73572e61e12 -->

<!-- START_4602ffdb615217b747777e559cc00227 -->
## api/vendor-list
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/vendor-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/vendor-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/vendor-list`


<!-- END_4602ffdb615217b747777e559cc00227 -->

<!-- START_35b767c075f8d6ec5e8c733604954aec -->
## api/health-package
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/health-package" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/health-package"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/health-package`


<!-- END_35b767c075f8d6ec5e8c733604954aec -->

<!-- START_33165f840bb2c656cc2efa9c0ff88d5c -->
## api/all-health-package
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/all-health-package" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/all-health-package"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/all-health-package`


<!-- END_33165f840bb2c656cc2efa9c0ff88d5c -->

<!-- START_fd22db2f36058d21b7f399420e768bb6 -->
## api/cart-count
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/cart-count" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/cart-count"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/cart-count`


<!-- END_fd22db2f36058d21b7f399420e768bb6 -->

<!-- START_3fca22a996de332edd9138ddd1078578 -->
## api/vendors-order-list
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/vendors-order-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/vendors-order-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/vendors-order-list`


<!-- END_3fca22a996de332edd9138ddd1078578 -->

<!-- START_477c86123dbc944fafc2d13b2aa10b93 -->
## api/delivery-boy-order-list
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/delivery-boy-order-list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/delivery-boy-order-list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/delivery-boy-order-list`


<!-- END_477c86123dbc944fafc2d13b2aa10b93 -->

<!-- START_271bd24ac96b6ca31b0b62fa119690d4 -->
## api/vendors-order-accept
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/vendors-order-accept" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/vendors-order-accept"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/vendors-order-accept`


<!-- END_271bd24ac96b6ca31b0b62fa119690d4 -->

<!-- START_a02d9ffddb798997c9f6f1ac968ca20f -->
## api/change-order-status
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/change-order-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/change-order-status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/change-order-status`


<!-- END_a02d9ffddb798997c9f6f1ac968ca20f -->

<!-- START_942c773edb51f79b0af84c8a5bff6b6e -->
## api/user-cancle-order
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/user-cancle-order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-cancle-order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/user-cancle-order`


<!-- END_942c773edb51f79b0af84c8a5bff6b6e -->

<!-- START_4e0b60c2f2749ad943d085a4440a7884 -->
## api/remove-wishlist-product
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/remove-wishlist-product" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/remove-wishlist-product"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/remove-wishlist-product`


<!-- END_4e0b60c2f2749ad943d085a4440a7884 -->

<!-- START_9c96b2cecc7d73c1718f87bfefcdcd92 -->
## api/user-address-delete
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/user-address-delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/user-address-delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/user-address-delete`


<!-- END_9c96b2cecc7d73c1718f87bfefcdcd92 -->

<!-- START_2c7b2d619d95866465a5d424ee601c43 -->
## api/edit-address
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/edit-address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/edit-address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/edit-address`


<!-- END_2c7b2d619d95866465a5d424ee601c43 -->

<!-- START_720105ccdb535ee2115acfcf159d04ba -->
## api/package-detail
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/package-detail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/package-detail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/package-detail`


<!-- END_720105ccdb535ee2115acfcf159d04ba -->

<!-- START_a35d4ac39e4e3fc5c54b3e39545abf7b -->
## api/sexsual
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/sexsual" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/sexsual"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/sexsual`


<!-- END_a35d4ac39e4e3fc5c54b3e39545abf7b -->

<!-- START_80b08db67fb33c31bb84a3d4e1406861 -->
## api/update-delivery-boy-location
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/update-delivery-boy-location" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/update-delivery-boy-location"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/update-delivery-boy-location`


<!-- END_80b08db67fb33c31bb84a3d4e1406861 -->

<!-- START_bf961ea3be7aead4b9bfc996303edea6 -->
## api/track-order-route
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/track-order-route" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/track-order-route"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/track-order-route`


<!-- END_bf961ea3be7aead4b9bfc996303edea6 -->

<!-- START_b7d1bab24eb1571e2a4f5473eaef2fbe -->
## api/all-state
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/all-state" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/all-state"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/all-state`


<!-- END_b7d1bab24eb1571e2a4f5473eaef2fbe -->

<!-- START_798195f75fc9c1415061dacbf011fdd8 -->
## api/doctor-time-slot
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/doctor-time-slot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-time-slot"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/doctor-time-slot`


<!-- END_798195f75fc9c1415061dacbf011fdd8 -->

<!-- START_841255d10523acaf492e237aa328981b -->
## api/doctor-dashboard
> Example request:

```bash
curl -X GET \
    -G "https://drhelpdesk.in/api/doctor-dashboard" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/doctor-dashboard"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": 200,
    "status": "Header Not Found ",
    "message": "Invalid AccessToken."
}
```

### HTTP Request
`GET api/doctor-dashboard`


<!-- END_841255d10523acaf492e237aa328981b -->

<!-- START_4c4402b2bf3f51b76984241c28194c31 -->
## api/clinic-details-submit
> Example request:

```bash
curl -X POST \
    "https://drhelpdesk.in/api/clinic-details-submit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "https://drhelpdesk.in/api/clinic-details-submit"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/clinic-details-submit`


<!-- END_4c4402b2bf3f51b76984241c28194c31 -->


