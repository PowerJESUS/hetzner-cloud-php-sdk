<?php
/**
 * Created by PhpStorm.
 * User: lukaskammerling
 * Date: 28.01.18
 * Time: 21:00
 */

namespace LKDev\HetznerCloud\Models\SSHKeys;

use LKDev\HetznerCloud\HetznerAPIClient;
use LKDev\HetznerCloud\Models\Model;

/**
 *
 */
class SSHKeys extends Model
{
    /**
     * @var array
     */
    public $sshKeys;

    /**
     * Creates a new SSH Key with the given name and public_key.
     *
     * @see https://docs.hetzner.cloud/#resources-ssh-keys-post
     * @param string $name
     * @param string $publicKey
     * @return \LKDev\HetznerCloud\Models\SSHKeys\SSHKey
     * @throws \LKDev\HetznerCloud\APIException
     */
    public function create(
    		string $name,
    		string $publicKey
    ): SSHKey {
    	$response = $this->httpClient->post('ssh_keys', [
    			'json' => [
    					'name' => $name,
    					'public_key' => $publicKey,
    			],
    	]);
    	if (! HetznerAPIClient::hasError($response)) {
    		return SSHKey::parse(json_decode((string) $response->getBody())->ssh_key);
    	}
    }

    /**
     * Returns all ssh key objects.
     *
     * @see https://docs.hetzner.cloud/#resources-ssh-keys-get
     * @return array
     * @throws \LKDev\HetznerCloud\APIException
     */
    public function all():array{
        $response = $this->httpClient->get('ssh_keys');
        if(!HetznerAPIClient::hasError($response)){
            return self::parse(json_decode((string) $response->getBody()))->sshKeys;
        }
    }

    /**
     * Returns a specific ssh key object.
     *
     * @see https://docs.hetzner.cloud/#resources-ssh-keys-get-1
     * @param int $sshKeyId
     * @return \LKDev\HetznerCloud\Models\SSHKeys\SSHKey
     * @throws \LKDev\HetznerCloud\APIException
     */
    public function get(int $sshKeyId): SSHKey{
        $response = $this->httpClient->get('ssh_keys/'.$sshKeyId);
        if (! HetznerAPIClient::hasError($response)) {
            return SSHKey::parse(json_decode((string) $response->getBody())->ssh_key);
        }
    }
    /**
     * @param  $input
     * @return $this
     */
    public function setAdditionalData( $input)
    {
        $this->sshKeys = collect($input->ssh_keys)->map(function ($sshKey, $key) {
            return SSHKey::parse($sshKey);
        })->toArray();

        return $this;
    }
    /**
     * @param  $input
     * @return $this|static
     */
    public static function parse( $input)
    {
        return (new self())->setAdditionalData($input);
    }
}
