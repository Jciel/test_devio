/*
 * My First API
 * No description provided (generated by Openapi Generator https://github.com/openapitools/openapi-generator)
 *
 * The version of the OpenAPI document: 0.1
 * 
 *
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


package org.openapitools.client.api;

import org.openapitools.client.ApiCallback;
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.ApiResponse;
import org.openapitools.client.Configuration;
import org.openapitools.client.Pair;
import org.openapitools.client.ProgressRequestBody;
import org.openapitools.client.ProgressResponseBody;

import com.google.gson.reflect.TypeToken;

import java.io.IOException;



import java.lang.reflect.Type;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class DefaultApi {
    private ApiClient localVarApiClient;

    public DefaultApi() {
        this(Configuration.getDefaultApiClient());
    }

    public DefaultApi(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    public ApiClient getApiClient() {
        return localVarApiClient;
    }

    public void setApiClient(ApiClient apiClient) {
        this.localVarApiClient = apiClient;
    }

    /**
     * Build call for call34ee6e9e8fa0c95d9bd89cfc374a81e2
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call34ee6e9e8fa0c95d9bd89cfc374a81e2Call(final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/v1/products";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] {  };
        return localVarApiClient.buildCall(localVarPath, "GET", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call call34ee6e9e8fa0c95d9bd89cfc374a81e2ValidateBeforeCall(final ApiCallback _callback) throws ApiException {
        

        okhttp3.Call localVarCall = call34ee6e9e8fa0c95d9bd89cfc374a81e2Call(_callback);
        return localVarCall;

    }

    /**
     * Retorna uma lista dos produtos
     * 
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public void call34ee6e9e8fa0c95d9bd89cfc374a81e2() throws ApiException {
        call34ee6e9e8fa0c95d9bd89cfc374a81e2WithHttpInfo();
    }

    /**
     * Retorna uma lista dos produtos
     * 
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> call34ee6e9e8fa0c95d9bd89cfc374a81e2WithHttpInfo() throws ApiException {
        okhttp3.Call localVarCall = call34ee6e9e8fa0c95d9bd89cfc374a81e2ValidateBeforeCall(null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     * Retorna uma lista dos produtos (asynchronously)
     * 
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call call34ee6e9e8fa0c95d9bd89cfc374a81e2Async(final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = call34ee6e9e8fa0c95d9bd89cfc374a81e2ValidateBeforeCall(_callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
    /**
     * Build call for search
     * @param q Parâemtro utilizado no filtro, pode ser o nome ou código do produto (required)
     * @param _callback Callback for upload/download progress
     * @return Call to execute
     * @throws ApiException If fail to serialize the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call searchCall(String q, final ApiCallback _callback) throws ApiException {
        Object localVarPostBody = null;

        // create path and map variables
        String localVarPath = "/v1/search?q={q}";

        List<Pair> localVarQueryParams = new ArrayList<Pair>();
        List<Pair> localVarCollectionQueryParams = new ArrayList<Pair>();
        Map<String, String> localVarHeaderParams = new HashMap<String, String>();
        Map<String, String> localVarCookieParams = new HashMap<String, String>();
        Map<String, Object> localVarFormParams = new HashMap<String, Object>();

        if (q != null) {
            localVarQueryParams.addAll(localVarApiClient.parameterToPair("q", q));
        }

        final String[] localVarAccepts = {
            
        };
        final String localVarAccept = localVarApiClient.selectHeaderAccept(localVarAccepts);
        if (localVarAccept != null) {
            localVarHeaderParams.put("Accept", localVarAccept);
        }

        final String[] localVarContentTypes = {
            
        };
        final String localVarContentType = localVarApiClient.selectHeaderContentType(localVarContentTypes);
        localVarHeaderParams.put("Content-Type", localVarContentType);

        String[] localVarAuthNames = new String[] {  };
        return localVarApiClient.buildCall(localVarPath, "GET", localVarQueryParams, localVarCollectionQueryParams, localVarPostBody, localVarHeaderParams, localVarCookieParams, localVarFormParams, localVarAuthNames, _callback);
    }

    @SuppressWarnings("rawtypes")
    private okhttp3.Call searchValidateBeforeCall(String q, final ApiCallback _callback) throws ApiException {
        
        // verify the required parameter 'q' is set
        if (q == null) {
            throw new ApiException("Missing the required parameter 'q' when calling search(Async)");
        }
        

        okhttp3.Call localVarCall = searchCall(q, _callback);
        return localVarCall;

    }

    /**
     * Retorna uma lista dos produtos filtrados pelo parâmetro passado
     * 
     * @param q Parâemtro utilizado no filtro, pode ser o nome ou código do produto (required)
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public void search(String q) throws ApiException {
        searchWithHttpInfo(q);
    }

    /**
     * Retorna uma lista dos produtos filtrados pelo parâmetro passado
     * 
     * @param q Parâemtro utilizado no filtro, pode ser o nome ou código do produto (required)
     * @return ApiResponse&lt;Void&gt;
     * @throws ApiException If fail to call the API, e.g. server error or cannot deserialize the response body
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public ApiResponse<Void> searchWithHttpInfo(String q) throws ApiException {
        okhttp3.Call localVarCall = searchValidateBeforeCall(q, null);
        return localVarApiClient.execute(localVarCall);
    }

    /**
     * Retorna uma lista dos produtos filtrados pelo parâmetro passado (asynchronously)
     * 
     * @param q Parâemtro utilizado no filtro, pode ser o nome ou código do produto (required)
     * @param _callback The callback to be executed when the API call finishes
     * @return The request call
     * @throws ApiException If fail to process the API call, e.g. serializing the request body object
     * @http.response.details
     <table summary="Response Details" border="1">
        <tr><td> Status Code </td><td> Description </td><td> Response Headers </td></tr>
        <tr><td> 200 </td><td>  </td><td>  -  </td></tr>
     </table>
     */
    public okhttp3.Call searchAsync(String q, final ApiCallback<Void> _callback) throws ApiException {

        okhttp3.Call localVarCall = searchValidateBeforeCall(q, _callback);
        localVarApiClient.executeAsync(localVarCall, _callback);
        return localVarCall;
    }
}