// No. 1

const nums = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

let promises = [];

for (let i = 0; i < nums.length; i++) {
    promises.push(new Promise((resolve, reject) => {
        if (nums[i] % 2 !== 0) {
            resolve(true);
        } else if (nums[i] % 2 === 0) {
            reject(false);
        }
        
    }));
}

Promise.allSettled(promises)
    .then((results) => {
        results.forEach((result, index) => {
            if (result.status === "fulfilled") {
                console.log(nums[index] + " isOdd");
            } else {
                console.log("");
            }
        });
    });


// No.2

function getRandomCharacter() {
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            const characterCode = Math.floor(Math.random() * 127);
            const randomCharacter = String.fromCharCode(characterCode);
            resolve(randomCharacter);
        }, 500);
    });
}

async function printRandomCharacter() {
    try {
        const randomChar = await getRandomCharacter();
        console.log("Resolve:", randomChar);
    } catch (error) {
        console.error("Reject:", error);
    }
}

printRandomCharacter();


// No.3


function getData1() {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        const randomChar = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
        reject(randomChar); 
      }, 500);
    });
  }
  
  async function fetchData() {
    try {
      const randomChar = await getData1();
      console.log('Resolve:', randomChar);
    } catch (error) {
      console.error('Reject:', error);
    }
  }
  
  fetchData();

// No.4

function getData() {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        const randomChar = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
        resolve(randomChar);
      }, 500);
    });
  }
  
  function rejectResolve() {
    const promises = [];
  
    for (let i = 0; i < 2; i++) {
      promises.push(new Promise((resolve, reject) => {
        setTimeout(() => {
          if (i === 0) {
            const randomChar = String.fromCharCode(Math.floor(Math.random() * 26) + 97);
            reject('Rejected (rejectResolve): ' + randomChar);
          } else {
            getData()
              .then(data => resolve('Resolved (rejectResolve): ' + data))
              .catch(error => reject('Error: ' + error));
          }
        }, 500 * i);
      }));
    }
  
    return Promise.allSettled(promises);
  }
  
  rejectResolve()
    .then(results => {
      results.forEach(result => {
        if (result.status === 'fulfilled') {
          console.log(result.value);
        } else {
          console.error(result.reason);
        }
      });
    });
  