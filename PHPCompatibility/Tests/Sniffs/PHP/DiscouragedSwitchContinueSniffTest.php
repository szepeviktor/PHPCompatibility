<?php
/**
 * Discouraged use of continue within switch sniff test file.
 *
 * @package PHPCompatibility
 */

namespace PHPCompatibility\Tests\Sniffs\PHP;

use PHPCompatibility\Tests\BaseSniffTest;
use PHPCompatibility\PHPCSHelper;

/**
 * Discouraged use of continue within switch sniff test.
 *
 * @group discouragedSwitchContinue
 * @group breakContinue
 *
 * @covers \PHPCompatibility\Sniffs\PHP\DiscouragedSwitchContinueSniff
 *
 * @uses    \PHPCompatibility\Tests\BaseSniffTest
 * @package PHPCompatibility
 * @author  Juliette Reinders Folmer <phpcompatibility_nospam@adviesenzo.nl>
 */
class DiscouragedSwitchContinueSniffTest extends BaseSniffTest
{
    const TEST_FILE = 'sniff-examples/discouraged_switch_continue.php';

    /**
     * testDiscouragedSwitchContinue
     *
     * @dataProvider dataDiscouragedSwitchContinue
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testDiscouragedSwitchContinue($line)
    {
        $file = $this->sniffFile(self::TEST_FILE, '7.3');
        $this->assertWarning($file, $line, "Targeting a 'switch' control structure with a 'continue' statement is strongly discouraged and will throw a warning as of PHP 7.3.");
    }

    /**
     * Data provider.
     *
     * @see testDiscouragedSwitchContinue()
     *
     * @return array
     */
    public function dataDiscouragedSwitchContinue()
    {
        return array(
            array(16),
            array(24),
            array(28),
            array(30),
            array(40),
            array(44),
            array(59),
            array(77),
            array(87),
            array(95),
            array(100),
            array(102),
            array(114),
            array(120),
            array(149),
            array(174),

            /*
            @todo: False negatives. Unscoped control structure within case.
            array(133),
            array(145),
            array(156),
            array(184),
            */
        );
    }


    /**
     * testNoFalsePositives
     *
     * @dataProvider dataNoFalsePositives
     *
     * @param int $line The line number.
     *
     * @return void
     */
    public function testNoFalsePositives($line)
    {
        $file = $this->sniffFile(self::TEST_FILE, '7.3');
        $this->assertNoViolation($file, $line);
    }

    /**
     * Data provider.
     *
     * @see testNoFalsePositives()
     *
     * @return array
     */
    public function dataNoFalsePositives()
    {
        return array(
            array(6),
            array(8),
            array(18),
            array(26),
            array(32),
            array(34),
            array(36),
            array(38),
            array(42),
            array(49),
            array(51),
            array(63),
            array(67),
            array(79),
            array(85),
            array(93),
            array(104),
            array(122),
            array(129),
            array(137),
            array(143),
            array(147),
            array(160),
            array(164),
            array(176),
            array(188),
        );
    }


    /**
     * Verify no notices are thrown at all.
     *
     * @return void
     */
    public function testNoViolationsInFileOnValidVersion()
    {
        $file = $this->sniffFile(self::TEST_FILE, '7.2');
        $this->assertNoViolation($file);
    }

}
