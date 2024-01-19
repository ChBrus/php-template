<?php
    namespace Core;

    use Core\Abstracts\ResponseAbstract;
    use Core\User;

    class UserResponse extends ResponseAbstract {
        public static function GET() {
            $user = new User();

            $query = $user->getQueryBuilder();

            $queryResponse = $query
                ->select('*')
                ->from('users')
                ->setFirstResult($user->__get('firstResult'))
                ->setMaxResults($user->__get('maxResults'))
                ->executeQuery()
            ;

            $response = new Response(200, $queryResponse->fetchAll());

            echo $response->__toString();
        }
    }