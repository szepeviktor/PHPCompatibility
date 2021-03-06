<?php
/**
 * Passing literal string $category to setlocale() sniff test file.
 *
 * @package PHPCompatibility
 */

namespace PHPCompatibility\Tests\Sniffs\FunctionParameters;

use PHPCompatibility\Tests\BaseSniffTest;

/**
 * Passing literal string $category to setlocale() sniff tests.
 *
 * @group setlocaleString
 * @group functionParameterValues
 *
 * @covers \PHPCompatibility\Sniffs\FunctionParameters\SetlocaleStringSniff
 *
 * @uses    \PHPCompatibility\Tests\BaseSniffTest
 * @package PHPCompatibility
 * @author  Juliette Reinders Folmer <phpcompatibility_nospam@adviesenzo.nl>
 */
class SetlocaleStringSniffTest extends BaseSniffTest
{

    const TEST_FILE = 'Sniffs/FunctionParameters/SetlocaleStringTestCases.inc';

    /**
     * testSetlocaleString
     *
     * @dataProvider dataSetlocaleString
     *
     * @param int $line Line number where the error should occur.
     *
     * @return void
     */
    public function testSetlocaleString($line)
    {
        $file = $this->sniffFile(self::TEST_FILE, '4.2');
        $this->assertWarning($file, $line, 'Passing the $category as a string to setlocale() has been deprecated since PHP 4.2; Pass one of the LC_* constants instead.');

        $file = $this->sniffFile(self::TEST_FILE, '7.0');
        $this->assertError($file, $line, 'Passing the $category as a string to setlocale() has been deprecated since PHP 4.2 and is removed since PHP 7.0; Pass one of the LC_* constants instead.');
    }

    /**
     * dataSetlocaleString
     *
     * @see testSetlocaleString()
     *
     * @return array
     */
    public function dataSetlocaleString()
    {
        return array(
            array(9),
            array(10),
        );
    }


    /**
     * testNoFalsePositives
     *
     * @return void
     */
    public function testNoFalsePositives()
    {
        $file = $this->sniffFile(self::TEST_FILE, '7.0');

        // No errors expected on the first 7 lines.
        for ($line = 1; $line <= 7; $line++) {
            $this->assertNoViolation($file, $line);
        }
    }


    /**
     * Verify no notices are thrown at all.
     *
     * @return void
     */
    public function testNoViolationsInFileOnValidVersion()
    {
        $file = $this->sniffFile(self::TEST_FILE, '4.1');
        $this->assertNoViolation($file);
    }
}
