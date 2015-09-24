# PHP JSONlite

##### A simple, self-contained, serverless, zero-configuration, [json](http://www.json.org/) document store. Based on [nodesocket/jsonlite](https://github.com/nodesocket/jsonlite).

JSONlite sandboxes the current working directory just like [SQLite](https://www.sqlite.org/). The data directory is named `jsonlite.data`, and each json document is saved pretty printed as a uuid.

## Proof of Concept

JSONlite is a proof of concept, and it may not make any sense to actually use it in development or production. Read more in [nodesocket/jsonlite](https://github.com/nodesocket/jsonlite).

## Installation

```
composer require wallacesilva/phpjsonlite
```

## Requirements

1. php >= 5.3

## Usage

> You need declare the object to use the methods.

```php
$jsonlite = new JSONlite\JSONlite();
// e.g.: $jsonlite->methodName();
```

#### set(```<string> $object [, <string> $document_id=null]```)

> Set object using OR not document_id

````php
$object = array(
    'id'            => 1, 
    'name'          => 'John Doe', 
    'active'        => true, 
    'permissions'   => array(
        'read'      => true,
        'write'     => false,
        'execute'   => true
    )
);
$document_id = $jsonlite->set($object);
// return also like: '666B81D6-3F8A-4D57-BA3F-11FA8FC47246'
````

#### get(```<string> $document_id```)

> Get object using document_id. Document id is a UUID 

````php
$object = $jsonlite->get($document_id);
// return also like:
/**
{
    "active": true,
    "name": "John Doe",
    "permissions": {
        "read": true,
        "write": false
    }
}
*/
````

#### delete(```<string> $document_id```)

> Delete object using document_id.

````
$deleted = $jsonlite->delete($document_id)
````

#### drop()

> Remove database folder. Default './jsonlite.data'

````php
$jsonlite->drop()
````

#### setDataPath(```<string> $dataPath```)

> Define new folder database. This is not required. Default is './jsonlite.data'

````
$jsonlite->setDataPath('/var/www/database/jsonlite.data/');
````

#### version

> Return version from Package

````php
$jsonlite->version()
// return also like: 0.1.0
````

## Changelog

https://github.com/wallacesilva/phpjsonlite/blob/master/CHANGELOG.md

## Support, Bugs, And Feature Requests

Create issues here in GitHub (https://github.com/wallacesilva/phpjsonlite/issues).

## Versioning

For transparency and insight into the release cycle, and for striving to maintain backward compatibility, JSONlite will be maintained under the semantic versioning guidelines.

Releases will be numbered with the follow format:

`<major>.<minor>.<patch>`

And constructed with the following guidelines:

+ Breaking backward compatibility bumps the major (and resets the minor and patch)
+ New additions without breaking backward compatibility bumps the minor (and resets the patch)
+ Bug fixes and misc changes bumps the patch

For more information on semantic versioning, visit http://semver.org/.

## License & Legal

Copyright 2015 Wallace Silva

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
