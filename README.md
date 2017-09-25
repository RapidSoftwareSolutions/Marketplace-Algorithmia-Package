[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Algorithmia/functions?utm_source=RapidAPIGitHub_AlgorithmiaFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)
# Algorithmia Package
Connect to the Algorithmia API to host language-agnostic functions and algorithms via an API. Test an API call and export the code snippet into your app.
* Domain: [algorithmia.com](https://algorithmia.com/)
* Credentials: apiKey

## How to get credentials:

0. Log in or sign up to [algorithmia.com](https://algorithmia.com/).
1. In the upper right corner select your profile picture->My Account->Credentials
2. Create new simple key.
3. Use API Key as credentials apiKeys.

## Algorithmia.callAlgorithm
You can call each algorithm from the Algorithmia marketplace.
On the [marketplace](https://algorithmia.com/algorithms), you’ll find an owner (the user who created the algorithm), an algorithm name

| Field   | Type       | Description
|---------|------------|----------
| apiKey  | credentials| The api key obtained from Algorithmia
| owner   | String     | Algorithm owner
| algoname| String     | Algorithm name
| data    | JSON       | Input for the algorithm. JSON object

## Algorithmia.checkExistence
Check if directory or file exists without downloading it

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| name     | String     | File or directory

## Algorithmia.listDirectoryContents
List the contents of a directory

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | Directory (relative to the root of a given data source)
| acl      | Boolean    | Include the directory ACL in the response. (Default = false) 

## Algorithmia.createDirectory
Create a directory through the Algorithmia Data API

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | Directory (relative to the root of a given data source)
| name     | String     | Name of the directory to create

## Algorithmia.updateDirectory
Update a directory

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | Directory (relative to the root of a given data source)
| acl      | JSON       | JSON object specifying permissions of the directory
##### ACL Attribute:
* ```[user://*]```: Readable by anyone (public)
* ```algo://.my/*```: Readable by your algorithms (default)
* Fully private is represented as an empty list

Example: ```"acl": {"read": []}``` implies the directory is fully private

## Algorithmia.deleteDirectory
Delete a directory

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | Directory (relative to the root of a given data source)
| force    | Boolean    | If true, enables recursive delete of a non-empty directory

## Algorithmia.getFile
Get a file through the Algorithmia Data API

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | File path (relative to the root of a given data source)

## Algorithmia.uploadFile
Upload a file through the Algorithmia Data API

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | Directory (relative to the root of a given data source)
| file     | File       | Uploaded file

## Algorithmia.deleteFile
Delete a file through the Algorithmia Data API

| Field    | Type       | Description
|----------|------------|----------
| apiKey   | credentials| The api key obtained from Algorithmia
| connector| Select     | The data source: data,dropbox,s3
| path     | String     | File path (relative to the root of a given data source)

