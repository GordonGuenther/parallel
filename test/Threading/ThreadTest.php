<?php

namespace Amp\Parallel\Test\Threading;

use Amp\Loop;
use Amp\Parallel\Test\AbstractContextTest;
use Amp\Parallel\Threading\Thread;

/**
 * @group threading
 * @requires extension pthreads
 */
class ThreadTest extends AbstractContextTest {
    public function createContext(callable $function) {
        return new Thread($function);
    }

    public function testSpawnStartsThread() {
        Loop::run(function () {
            $thread = Thread::spawn(function () {
                usleep(100);
            });

            $this->assertTrue($thread->isRunning());

            return yield $thread->join();
        });
    }
}
