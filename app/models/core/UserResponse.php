<?php
    namespace Core;

    use Core\Abstracts\ResponseAbstract;
    use Core\Exception\DatabaseException;
    use Core\User;
    use Core\Response;
    use Exception;

    class UserResponse extends ResponseAbstract {
        public static function GET() {
            try {
                $user = new User();

                if (isset($_COOKIE['maxRows'])) {
                    $user->setMaxResults($_COOKIE['maxRows']);
                }

                $user->setFirstResult($_GET['page']);

                if (isset($_GET['type'])) {
                    echo match($_GET['type']) {
                        'search' => self::search(
                            object: $user,
                            table: 'users'
                        ),
                        default => self::GETAll($user)
                    };
                } else {
                    echo self::GETAll($user);
                }
            } catch (Exception $e) {
                $error = new DatabaseException($e->getMessage(), $e->getCode(), $e->getPrevious());
                $errorResponse = new Response($e->getCode(), $error->show());

                die($errorResponse->__toString());
            }
        }

        private static function GETAll($user) {
            try {
                $query = $user->getQueryBuilder();

                $queryResponse = $query
                    ->select('*')
                    ->from('users')
                    ->setFirstResult($user->__get('firstResult'))
                    ->setMaxResults($user->__get('maxResults'))
                    ->executeQuery()
                ;

                if ($user->__get('firstResult') === 0) {
                    self::count(
                        object: $user,
                        table: 'users'
                    );
                }

                $response = new Response(200, $queryResponse->fetchAll());

                return $response->__toString();
            } catch (Exception $e) {
                $error = new DatabaseException($e->getMessage(), $e->getCode(), $e->getPrevious());
                $error->configAlert('header', '[ERROR] Petición al servidor');
                $errorResponse = new Response($e->getCode(), $error->show());

                return $errorResponse->__toString();
            }
        }
    }