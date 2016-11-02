<?php

namespace CoreDomain\Base\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class AbstractRepository
 */
abstract class AbstractRepository extends EntityRepository
{
    /**
     * Save entity
     *
     * @param mixed   $entity
     * @param boolean $andFlush
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save($entity, $andFlush = true)
    {
        $this->_em->persist($entity);
        if ($andFlush) {
            $this->_em->flush();
        }
    }

    /**
     * Delete entity
     *
     * @param mixed   $entity
     * @param boolean $andFlush
     * @throws \Doctrine\ORM\ORMInvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete($entity, $andFlush = true)
    {
        $this->_em->remove($entity);
        if ($andFlush) {
            $this->_em->flush();
        }
    }

    /**
     * Start transaction
     */
    public function beginTransaction()
    {
        $this->_em->beginTransaction();
    }

    /**
     * Commit transaction
     */
    public function commit()
    {
        $this->_em->commit();
    }

    /**
     * Rollback transaction
     */
    public function rollback()
    {
        $this->_em->rollback();
    }

    /**
     * Flush results
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function flush()
    {
        $this->_em->flush();
    }
}