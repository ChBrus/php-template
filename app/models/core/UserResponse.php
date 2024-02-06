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

                $user->setFirstResult($_GET['page']);
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
                        user: $user,
                        table: 'users'
                    );
                }

                $response = new Response(200, $queryResponse->fetchAll());

                echo $response->__toString();
            } catch (Exception $e) {
                $error = new DatabaseException($e->getMessage(), $e->getCode(), $e->getPrevious());
                $errorResponse = new Response($e->getCode(), $error->show());

                die($errorResponse->__toString());
            }
        }

        /**
         * Cuenta la cantidad de ítems en una tabla
         *
         * @param string $table
         * @param User $user
         * @return void
         */
        private static function count($table, $user) {
            $queryBuilder = $user->getQueryBuilder();

            $query = $queryBuilder
                ->select('COUNT(*)')
                ->from($table)
                ->executeQuery()
            ;

            $maxData = $query->fetchOne();
            $maxData = ceil($maxData / $user->__get('maxResults'));

            setcookie('maxPages', $maxData, time() + 60*60*24,'/');
        }
    }