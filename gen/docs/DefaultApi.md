# DefaultApi

All URIs are relative to *http://localhost*

Method | HTTP request | Description
------------- | ------------- | -------------
[**call34ee6e9e8fa0c95d9bd89cfc374a81e2**](DefaultApi.md#call34ee6e9e8fa0c95d9bd89cfc374a81e2) | **GET** /v1/products | Retorna uma lista dos produtos
[**search**](DefaultApi.md#search) | **GET** /v1/search?q&#x3D;{q} | Retorna uma lista dos produtos filtrados pelo parâmetro passado


<a name="call34ee6e9e8fa0c95d9bd89cfc374a81e2"></a>
# **call34ee6e9e8fa0c95d9bd89cfc374a81e2**
> call34ee6e9e8fa0c95d9bd89cfc374a81e2()

Retorna uma lista dos produtos

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.DefaultApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    DefaultApi apiInstance = new DefaultApi(defaultClient);
    try {
      apiInstance.call34ee6e9e8fa0c95d9bd89cfc374a81e2();
    } catch (ApiException e) {
      System.err.println("Exception when calling DefaultApi#call34ee6e9e8fa0c95d9bd89cfc374a81e2");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters
This endpoint does not need any parameter.

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** |  |  -  |

<a name="search"></a>
# **search**
> search(q)

Retorna uma lista dos produtos filtrados pelo parâmetro passado

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.models.*;
import org.openapitools.client.api.DefaultApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://localhost");

    DefaultApi apiInstance = new DefaultApi(defaultClient);
    String q = "q_example"; // String | Parâemtro utilizado no filtro, pode ser o nome ou código do produto
    try {
      apiInstance.search(q);
    } catch (ApiException e) {
      System.err.println("Exception when calling DefaultApi#search");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **q** | **String**| Parâemtro utilizado no filtro, pode ser o nome ou código do produto |

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** |  |  -  |

